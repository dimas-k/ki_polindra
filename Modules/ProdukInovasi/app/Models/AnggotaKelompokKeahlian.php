<?php

namespace Modules\ProdukInovasi\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKelompokKeahlian extends Model
{
    use HasFactory;

    protected $table = 'anggota_kelompok_keahlians'; // Nama tabel
    protected $fillable = [
        'kbk_id',
        'nama_lengkap',
        'jabatan',
        'email',
    ];

    /**
     * Relasi ke tabel `produks` melalui tabel pivot `produks_anggotas`
     * Menggunakan polimorfisme (morphTo)
     */
    public function produk()
    {
        return $this->morphToMany(
            Produk::class,
            'anggota',       // Nama relasi polimorfik
            'produks_anggotas', // Nama tabel pivot
            'anggota_id',     // Kolom ID anggota
            'produk_id'       // Kolom ID produk
        );
    }
    public function penelitian()
    {
        return $this->morphToMany(
            Penelitian::class,
            'anggota',       // Nama relasi polimorfik
            'penelitians_anggotas', // Nama tabel pivot
            'anggota_id',     // Kolom ID anggota
            'penelitian_id'       // Kolom ID produk
        );
    }

    /**
     * Relasi ke tabel `kelompok_keahlians`
     */
    public function kelompokKeahlian()
    {
        return $this->belongsTo(KelompokKeahlian::class, 'kbk_id');
    }
}
