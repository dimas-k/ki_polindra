<?php

namespace App\Console\Commands;

use App\Mail\KiPaymentInvoiceMail;
use App\Models\DesainIndustri;
use App\Models\HakCipta;
use App\Models\Payment;
use App\Models\Paten;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPaymentDueReminders extends Command
{
    /**
     * php artisan payments:remind-due
     * Kirim email pengingat untuk tagihan yang akan jatuh tempo dalam 24 jam ke depan
     * dan belum lunas, sekali per tagihan (ditandai kolom reminder_terkirim).
     */
    protected $signature = 'payments:remind-due';

    protected $description = 'Kirim email pengingat tenggat pembayaran yang akan jatuh tempo dalam 24 jam';

    public function handle(): int
    {
        $this->markOverdueAsExpired();

        $payments = Payment::where('status', Payment::STATUS_MENUNGGU)
            ->where('reminder_terkirim', false)
            ->whereBetween('tenggat_pembayaran', [now(), now()->addDay()])
            ->get();

        if ($payments->isEmpty()) {
            $this->info('Tidak ada tagihan yang perlu diingatkan saat ini.');
            return self::SUCCESS;
        }

        foreach ($payments as $payment) {
            $pengajuan = $payment->payable;

            if (!$pengajuan || empty($pengajuan->email)) {
                continue;
            }

            $judul = match ($payment->payable_type) {
                Paten::class => $pengajuan->judul_paten,
                HakCipta::class => $pengajuan->judul_ciptaan,
                DesainIndustri::class => $pengajuan->judul_di,
                default => '-',
            };

            Mail::to($pengajuan->email)->send(new KiPaymentInvoiceMail(
                payment: $payment,
                namaPengaju: $pengajuan->nama_lengkap,
                judul: $judul,
                paymentUrl: route('payment.show', $payment->order_id),
                isReminder: true,
            ));

            $payment->update(['reminder_terkirim' => true]);

            $this->line("Reminder terkirim: {$payment->order_id} ke {$pengajuan->email}");
        }

        $this->info("Selesai. {$payments->count()} email pengingat terkirim.");

        return self::SUCCESS;
    }

    /**
     * Tandai tagihan yang sudah lewat tenggat waktu dan belum dibayar sebagai Kadaluarsa.
     */
    protected function markOverdueAsExpired(): void
    {
        $expired = Payment::where('status', Payment::STATUS_MENUNGGU)
            ->where('tenggat_pembayaran', '<', now())
            ->update(['status' => Payment::STATUS_KADALUARSA]);

        if ($expired > 0) {
            $this->line("{$expired} tagihan ditandai Kadaluarsa.");
        }
    }
}
