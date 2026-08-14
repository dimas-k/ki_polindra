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
            Log::warning('Email pengajuan HakCipta #' . $hc->id . ' tidak dikirim: field email kosong.');
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
            Log::info('Email pengajuan diterima berhasil dikirim (HakCipta #' . $hc->id . ') ke ' . $hc->email);
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email pengajuan diterima (HakCipta #' . $hc->id . ') ke ' . $hc->email . ': ' . $e->getMessage());
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
            Log::info('Email perubahan status berhasil dikirim (HakCipta #' . $hc->id . ') ke ' . $hc->email);
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email perubahan status (HakCipta #' . $hc->id . ') ke ' . $hc->email . ': ' . $e->getMessage());
        }
    }
}