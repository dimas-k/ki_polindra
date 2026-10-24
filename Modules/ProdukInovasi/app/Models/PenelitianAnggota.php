<?php

namespace Modules\ProdukInovasi\app\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenelitianAnggota extends Model
{
    use HasFactory;

    protected $table = 'penelitians_anggotas';

    protected $fillable = [
        'penelitian_id',
        'anggota_id',
        'anggota_type', // Polimorfisme
    ];

    public function detailAnggota()
    {
        return $this->belongsTo(AnggotaKelompokKeahlian::class, 'anggota_id');
    }

    public function detail()
    {
        return $this->morphTo(null, 'anggota_type', 'anggota_id');
    }

    public function anggota()
    {
        return $this->morphTo(null, 'anggota_type', 'anggota_id');
    }

    public function userAnggota()
    {
        return $this->belongsTo(User::class, 'anggota_id');
    }

    // Relasi ke model Penelitian
    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'penelitian_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'anggota_id'); // Harus menggunakan anggota_id
    }


}
