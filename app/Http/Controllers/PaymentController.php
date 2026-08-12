<?php

namespace App\Http\Controllers;

use App\Mail\KiPaymentInvoiceMail;
use App\Mail\KiPaymentReceivedMail;
use App\Models\DesainIndustri;
use App\Models\HakCipta;
use App\Models\Payment;
use App\Models\Paten;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected MidtransService $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    /**
     * Map slug jenis KI dari URL ke Model class-nya.
     */
    protected function resolveModel(string $jenis): string
    {
        return match ($jenis) {
            'paten' => Paten::class,
            'hak-cipta' => HakCipta::class,
            'desain-industri' => DesainIndustri::class,
            default => abort(404, 'Jenis pengajuan tidak dikenal'),
        };
    }

    /**
     * (Admin) Buat tagihan pembayaran baru untuk sebuah pengajuan
     * dan kirim invoice via email.
     *
     * Route: POST /admin/{jenis}/{id}/tagihan
     */
    public function store(Request $request, string $jenis, string $id)
    {
        $request->validate([
            'nominal' => 'required|integer|min:1000',
            'deskripsi' => 'nullable|string|max:255',
            'tenggat_pembayaran' => 'nullable|date|after:now',
        ]);

        $modelClass = $this->resolveModel($jenis);
        $pengajuan = $modelClass::findOrFail($id);

        $judul = match ($modelClass) {
            Paten::class => $pengajuan->judul_paten,
            HakCipta::class => $pengajuan->judul_ciptaan,
            DesainIndustri::class => $pengajuan->judul_di,
        };

        $orderId = 'SIKI-' . strtoupper(Str::random(4)) . '-' . $pengajuan->id . '-' . time();

        $tenggat = $request->filled('tenggat_pembayaran')
            ? $request->date('tenggat_pembayaran')
            : now()->addHours((int) config('midtrans.default_expiry_hours'));

        $payment = Payment::create([
            'payable_type' => $modelClass,
            'payable_id' => $pengajuan->id,
            'user_id' => $pengajuan->user_id,
            'order_id' => $orderId,
            'deskripsi' => $request->input('deskripsi', 'Biaya pengurusan ' . $judul),
            'nominal' => $request->input('nominal'),
            'status' => Payment::STATUS_MENUNGGU,
            'tenggat_pembayaran' => $tenggat,
        ]);

        try {
            $snap = $this->midtrans->createSnapTransaction(
                orderId: $orderId,
                nominal: (int) $payment->nominal,
                customer: [
                    'name' => $pengajuan->nama_lengkap,
                    'email' => $pengajuan->email,
                    'phone' => $pengajuan->no_telepon,
                ],
                itemName: $payment->deskripsi,
            );

            $payment->update(['snap_token' => $snap['token']]);
        } catch (\Throwable $e) {
            Log::error('Gagal membuat transaksi Midtrans: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat tagihan pembayaran. Periksa konfigurasi Midtrans.');
        }

        try {
            Mail::to($pengajuan->email)->send(new KiPaymentInvoiceMail(
                payment: $payment,
                namaPengaju: $pengajuan->nama_lengkap,
                judul: $judul,
                paymentUrl: route('payment.show', $payment->order_id),
            ));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email tagihan pembayaran (Payment #' . $payment->id . '): ' . $e->getMessage());
            return back()->with('success', 'Tagihan pembayaran berhasil dibuat, tetapi email invoice gagal terkirim. Silakan cek konfigurasi email atau bagikan tautan pembayaran secara manual.');
        }

        return back()->with('success', 'Tagihan pembayaran berhasil dibuat dan invoice telah dikirim ke email pengaju.');
    }

    /**
     * Halaman pembayaran (menampilkan tombol Snap Midtrans).
     *
     * Route: GET /pembayaran/{order_id}
     */
    public function show(string $orderId)
    {
        $payment = Payment::where('order_id', $orderId)->firstOrFail();

        // Hanya pemilik pengajuan atau admin yang boleh membuka halaman ini
        abort_unless(
            Auth::check() && (Auth::id() === $payment->user_id || Auth::user()->apakahAdmin()),
            403
        );

        return view('payment.show', [
            'payment' => $payment,
            'clientKey' => config('midtrans.client_key'),
            'isProduction' => config('midtrans.is_production'),
        ]);
    }

    /**
     * Webhook notifikasi dari Midtrans. CSRF di-exclude untuk route ini.
     *
     * Route: POST /midtrans/notification
     */
    public function notification(Request $request)
    {
        $payload = $request->all();

        if (!$this->midtrans->verifySignature($payload)) {
            Log::warning('Midtrans notification signature tidak valid', $payload);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('order_id', $payload['order_id'] ?? null)->first();

        if (!$payment) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        $newStatus = $this->midtrans->mapStatus(
            $payload['transaction_status'] ?? '',
            $payload['fraud_status'] ?? null,
        );

        $payment->raw_response = $payload;
        $payment->metode_pembayaran = $payload['payment_type'] ?? $payment->metode_pembayaran;
        $payment->midtrans_transaction_id = $payload['transaction_id'] ?? $payment->midtrans_transaction_id;

        if ($newStatus) {
            $wasLunas = $payment->isLunas();
            $payment->status = $newStatus;

            if ($newStatus === Payment::STATUS_DIBAYAR) {
                $payment->paid_at = now();
            }

            $payment->save();

            if ($newStatus === Payment::STATUS_DIBAYAR && !$wasLunas) {
                $this->sendPaymentReceivedEmailSafely($payment);
            }
        } else {
            $payment->save();
        }

        return response()->json(['message' => 'OK']);
    }

    protected function sendPaymentReceivedEmail(Payment $payment): void
    {
        $pengajuan = $payment->payable;

        if (!$pengajuan || empty($pengajuan->email)) {
            return;
        }

        $judul = match ($payment->payable_type) {
            Paten::class => $pengajuan->judul_paten,
            HakCipta::class => $pengajuan->judul_ciptaan,
            DesainIndustri::class => $pengajuan->judul_di,
            default => '-',
        };

        Mail::to($pengajuan->email)->send(new KiPaymentReceivedMail(
            payment: $payment,
            namaPengaju: $pengajuan->nama_lengkap,
            judul: $judul,
        ));
    }

    protected function sendPaymentReceivedEmailSafely(Payment $payment): void
    {
        try {
            $this->sendPaymentReceivedEmail($payment);
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email pembayaran diterima (Payment #' . $payment->id . '): ' . $e->getMessage());
        }
    }
}