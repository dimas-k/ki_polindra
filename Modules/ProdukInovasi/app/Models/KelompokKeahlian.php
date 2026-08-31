<?php

namespace Modules\ProdukInovasi\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelompokKeahlian extends Model
{
    use HasFactory;

    protected $table = 'kelompok_keahlians';

    public function user()
    {
        return $this->hasOne(User::class, 'kbk_id');
        // return $this->hasMany(User::class, 'kbk_id');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kbk_id');
    }

    public function penelitian()
    {
        return $this->hasMany(Penelitian::class, 'kbk_id');
    }
    public function anggota()
    {
        return $this->hasMany(AnggotaKelompokKeahlian::class, 'kbk_id');
    }
}
