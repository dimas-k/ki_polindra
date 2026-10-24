<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = [
        'jurusan_id',
        'nama_prodi',
        'kode_prodi',
    ];

    /**
     * Cari id prodi berdasarkan nama (tanpa peduli besar/kecil huruf & spasi).
     * Dipakai controller yang formnya masih mengirim nama prodi sebagai teks,
     * supaya kolom prodi_id (relasi FK) ikut terisi otomatis.
     */
    public static function findIdByName(?string $namaProdi): ?int
    {
        if (empty($namaProdi)) {
            return null;
        }

        return static::whereRaw('LOWER(TRIM(nama_prodi)) = ?', [strtolower(trim($namaProdi))])
            ->value('id');
    }

    /**
     * Satu prodi milik satu jurusan.
     */
    public function jurusan() : BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Satu prodi punya banyak pengajuan paten.
     */
    public function paten() : HasMany
    {
        return $this->hasMany(Paten::class);
    }

    /**
     * Satu prodi punya banyak pengajuan hak cipta.
     */
    public function hakCipta() : HasMany
    {
        return $this->hasMany(HakCipta::class);
    }

    /**
     * Satu prodi punya banyak pengajuan desain industri.
     */
    public function desainIndustri() : HasMany
    {
        return $this->hasMany(DesainIndustri::class);
    }
}
