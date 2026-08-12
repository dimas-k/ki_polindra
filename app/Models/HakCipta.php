<?php

namespace App\Models;

use App\Models\CheckHc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HakCipta extends Model
{
    use HasFactory;
    protected $table = 'hak_cipta';
    protected $guarded = 'id';
    protected static function booted()
    {
        static::deleting(function ($hc) {
            // Daftar file yang disimpan di private storage
            $privateFiles = [
                'ktp_inventor',
                'data_pengaju2',
                'surat_pengalihan',
                'surat_pernyataan'
            ];

            // Daftar file yang disimpan di public storage
            $publicFiles = [
                'dokumen_invensi',    
                'sertifikat_hakcipta',    
            ];

            foreach ($privateFiles as $field) {
                if (!empty($hc->{$field})) {
                    Storage::disk('private')->delete($hc->{$field});
                }
            }

            foreach ($publicFiles as $field) {
                if (!empty($hc->{$field})) {
                    Storage::disk('public')->delete($hc->{$field});
                }
            }
        });
    }
    public function cekhc() :HasOne
    {
        return $this->hasOne(CheckHc::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(\App\Models\Payment::class, 'payable')->latestOfMany();
    }
}
