<?php

namespace App\Models;

use App\Models\Jurusan;
use App\Models\CheckPaten;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paten extends Model
{
    use HasFactory;
    protected $searchable = [
        'nama_lengkap',
        'judul_paten'
    ];

    protected $guarded = 'id';
    protected $table = 'paten';

    protected static function booted()
    {
        static::deleting(function ($paten) {
            // Daftar file yang disimpan di private storage
            $privateFiles = [
                'ktp_inventor',
                'data_pengaju2',
                'pengalihan_hak',
                'klaim',
                'pernyataan_kepemilikan',
                'surat_kuasa'
            ];

            // Daftar file yang disimpan di public storage
            $publicFiles = [
                'deskripsi_paten',
                'abstrak_paten',
                'gambar_paten',
                'gambar_tampilan',
                'sertifikat_paten'
                
            ];

            foreach ($privateFiles as $field) {
                if (!empty($paten->{$field})) {
                    Storage::disk('private')->delete($paten->{$field});
                }
            }

            foreach ($publicFiles as $field) {
                if (!empty($paten->{$field})) {
                    Storage::disk('public')->delete($paten->{$field});
                }
            }
        });
    }

    public function cek() : HasOne
    {
        return $this->hasOne(CheckPaten::class);
    }

    public function jurusan() : HasMany
    {
        return $this->hasMany(Jurusan::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Payment::class, 'payable')->latestOfMany();
    }

}
