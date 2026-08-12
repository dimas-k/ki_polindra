<?php

namespace App\Observers;

use App\Mail\KiStatusChangedMail;
use App\Mail\KiSubmissionReceivedMail;
use App\Models\HakCipta;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HakCiptaObserver
{
    public function created(HakCipta $hc): void
    {
        if (empty($hc->email)) {
            return;
        }

        if (is_null($hc->status)) {
            $hc->refresh();
        }

        try {
            Mail::to($hc->email)->send(new KiSubmissionReceivedMail(
                namaPengaju: $hc->nama_lengkap,
                jenisKi: 'Hak Cipta',
                judul: $hc->judul_ciptaan,
                status: $hc->status ?? '-',
            ));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email pengajuan diterima (HakCipta #' . $hc->id . '): ' . $e->getMessage());
        }
    }

    public function updated(HakCipta $hc): void
    {
        if (!$hc->isDirty('status') || empty($hc->email)) {
            return;
        }

        try {
            Mail::to($hc->email)->send(new KiStatusChangedMail(
                namaPengaju: $hc->nama_lengkap,
                jenisKi: 'Hak Cipta',
                judul: $hc->judul_ciptaan,
                statusLama: $hc->getOriginal('status'),
                statusBaru: $hc->status,
            ));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email perubahan status (HakCipta #' . $hc->id . '): ' . $e->getMessage());
        }
    }
}