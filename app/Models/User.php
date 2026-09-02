<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\ActivityLog;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'no_telepon',
        'email',
        'alamat',
        'ktp',
        'kerjaan',
        'jabatan',
        'nip',
        'pas_foto',
        'kbk_id',
        'username',
        'password',
        'role',
    ];


    /**
     * Relasi ke Kelompok Bidang Keahlian (KBK) yang dipimpin/diikuti
     * oleh user ini (khususnya untuk role Ketua KBK).
     */
    public function kelompokKeahlian()
    {
        return $this->belongsTo(\Modules\ProdukInovasi\app\Models\KelompokKeahlian::class, 'kbk_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function apakahAdmin(){
        return $this->role === 'Admin';
    }
    public function apakahDosen(){
        return $this->role === 'Dosen';
    }
    public function apakahUmum(){
        return $this->role === 'Umum';
    }
    public function apakahKetuaKbk(){
        return $this->role === 'Ketua KBK';
    }

    // protected static function booted()
    // {
    //     static::created(function ($user){
    //         ActivityLog::create([
    //             'descriptions' => 'create user ' . $user->nama_lengkap . ' Role ' . $user->role
    //         ]);
    //     });
    // }
}