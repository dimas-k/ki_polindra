<?php

namespace App\Observers;

use App\Mail\KiStatusChangedMail;
use App\Mail\KiSubmissionReceivedMail;
use App\Models\Paten;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PatenObserver
{
    public function created(Paten $paten): void
    {
        if (empty($paten->email)) {
            return;
        }

        if (is_null($paten->status)) {
            $paten->refresh();
        }

        try {
            Mail::to($paten->email)->send(new KiSubmissionReceivedMail(
                namaPengaju: $paten->nama_lengkap,
                jenisKi: 'Paten',
                judul: $paten->judul_paten,
                status: $paten->status ?? '-',
            ));
        } catch (\Throwable $e) {
            // Kegagalan kirim email (mis. SMTP down/salah kredensial) tidak boleh
            // menggagalkan proses penyimpanan data pengajuan yang sudah berhasil.
            Log::error('Gagal mengirim email pengajuan diterima (Paten #' . $paten->id . '): ' . $e->getMessage());
        }
    }

    public function updated(Paten $paten): void
    {
        if (!$paten->isDirty('status') || empty($paten->email)) {
            return;
        }

        try {
            Mail::to($paten->email)->send(new KiStatusChangedMail(
                namaPengaju: $paten->nama_lengkap,
                jenisKi: 'Paten',
                judul: $paten->judul_paten,
                statusLama: $paten->getOriginal('status'),
                statusBaru: $paten->status,
            ));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email perubahan status (Paten #' . $paten->id . '): ' . $e->getMessage());
        }
    }
}