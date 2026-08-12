<?php

namespace App\Observers;

use App\Mail\KiStatusChangedMail;
use App\Mail\KiSubmissionReceivedMail;
use App\Models\DesainIndustri;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DesainIndustriObserver
{
    public function created(DesainIndustri $di): void
    {
        if (empty($di->email)) {
            return;
        }

        if (is_null($di->status)) {
            $di->refresh();
        }

        try {
            Mail::to($di->email)->send(new KiSubmissionReceivedMail(
                namaPengaju: $di->nama_lengkap,
                jenisKi: 'Desain Industri',
                judul: $di->judul_di,
                status: $di->status ?? '-',
            ));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email pengajuan diterima (DesainIndustri #' . $di->id . '): ' . $e->getMessage());
        }
    }

    public function updated(DesainIndustri $di): void
    {
        if (!$di->isDirty('status') || empty($di->email)) {
            return;
        }

        try {
            Mail::to($di->email)->send(new KiStatusChangedMail(
                namaPengaju: $di->nama_lengkap,
                jenisKi: 'Desain Industri',
                judul: $di->judul_di,
                statusLama: $di->getOriginal('status'),
                statusBaru: $di->status,
            ));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email perubahan status (DesainIndustri #' . $di->id . '): ' . $e->getMessage());
        }
    }
}