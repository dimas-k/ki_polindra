<?php

namespace App\Models;

use App\Models\CheckDi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DesainIndustri extends Model
{
    use HasFactory;
    protected $table = 'desain_industri';
    protected $guarded = 'id';

    protected static function booted()
    {
        static::deleting(function ($di) {
            // Daftar file yang disimpan di private storage
            $privateFiles = [
                'ktp_inventor' ,
                'data_pengaju2',
                'surat_kepemilikan',
                'surat_pengalihan'
            ];

            // Daftar file yang disimpan di public storage
            $publicFiles = [
                'gambar_di', 
                'uraian_di',
                'sertifikat_desain'
            ];

            foreach ($privateFiles as $field) {
                if (!empty($di->{$field})) {
                    Storage::disk('private')->delete($di->{$field});
                }
            }

            foreach ($publicFiles as $field) {
                if (!empty($di->{$field})) {
                    Storage::disk('public')->delete($di->{$field});
                }
            }
        });
    }

    public function cekDi() : HasOne
    {
        return $this->hasOne(CheckDi::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(\App\Models\Payment::class, 'payable')->latestOfMany();
    }
}
