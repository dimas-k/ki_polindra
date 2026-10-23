<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\KiPaymentReceivedMail;
use App\Models\DesainIndustri;
use App\Models\HakCipta;
use App\Models\Paten;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminPaymentVerifikasiController extends Controller
{
    /**
     * Daftar pembayaran manual yang menunggu diverifikasi admin
     * (pengaju sudah transfer & mengunggah bukti).
     */
    public function index()
    {
        $payments = Payment::with(['payable', 'bankAccount'])
            ->where('tipe_pembayaran', Payment::TIPE_MANUAL)
            ->where('status', Payment::STATUS_MENUNGGU_VERIFIKASI)
            ->orderBy('created_at')
            ->get();

        return view('kekayaanintelektual::admin.payment.verifikasi.index', compact('payments'));
    }

    /**
     * Setujui pembayaran manual: tandai lunas & kirim email konfirmasi.
     */
    public function setujui(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);

        abort_unless($payment->menungguVerifikasi(), 422, 'Pembayaran ini tidak sedang menunggu verifikasi.');

        $payment->update([
            'status' => Payment::STATUS_DIBAYAR,
            'paid_at' => now(),
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'catatan_verifikasi' => $request->input('catatan_verifikasi'),
        ]);

        $this->kirimEmailLunasAman($payment);

        return redirect('/admin/payment/verifikasi')->with('success', 'Pembayaran berhasil diverifikasi dan dinyatakan lunas.');
    }

    /**
     * Tolak bukti pembayaran manual (mis. bukti tidak valid/nominal tidak sesuai).
     * Status dikembalikan ke "Menunggu Pembayaran" supaya pengaju bisa unggah ulang.
     */
    public function tolak(Request $request, string $id)
    {
        $request->validate([
            'catatan_verifikasi' => 'required|string|max:500',
        ]);

        $payment = Payment::findOrFail($id);

        abort_unless($payment->menungguVerifikasi(), 422, 'Pembayaran ini tidak sedang menunggu verifikasi.');

        $payment->update([
            'status' => Payment::STATUS_MENUNGGU,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'catatan_verifikasi' => $request->input('catatan_verifikasi'),
        ]);

        return redirect('/admin/payment/verifikasi')->with('success', 'Bukti pembayaran ditolak. Pengaju diminta mengunggah ulang bukti transfer.');
    }

    /**
     * Tampilkan file bukti transfer yang diunggah pengaju (disk privat).
     */
    public function bukti(string $id)
    {
        $payment = Payment::findOrFail($id);

        abort_if(empty($payment->bukti_pembayaran), 404);
        abort_unless(Storage::disk('local')->exists($payment->bukti_pembayaran), 404);

        return Storage::disk('local')->response($payment->bukti_pembayaran);
    }

    protected function kirimEmailLunasAman(Payment $payment): void
    {
        try {
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
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email konfirmasi pembayaran (Payment #' . $payment->id . '): ' . $e->getMessage());
        }
    }
}
