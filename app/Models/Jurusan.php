<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';

    protected $fillable = [
        'nama_jurusan',
        'kode_jurusan',
    ];
    
    public function paten() : BelongsTo
    {
        return $this->belongsTo(Paten::class);
    }

    /**
     * Satu jurusan punya banyak prodi.
     */
    public function prodi() : HasMany
    {
        return $this->hasMany(Prodi::class);
    }
}
