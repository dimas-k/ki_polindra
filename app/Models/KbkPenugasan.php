<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KbkPenugasan extends Model
{
    protected $table = 'kbk_penugasan';

    protected $guarded = [];

    protected $casts = [
        'mulai' => 'date',
        'selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kbk()
    {
        return $this->belongsTo(\Modules\ProdukInovasi\app\Models\KelompokKeahlian::class, 'kbk_id');
    }

    /** ID user yang sedang menjabat sebagai Ketua KBK (penugasan aktif). */
    public static function ketuaAktifUserIds(): array
    {
        return static::where('peran', 'ketua')->whereNull('selesai')
            ->pluck('user_id')->unique()->values()->all();
    }

    /**
     * Atur penugasan KBK satu user.
     * $kbkId null  -> lepas dari semua KBK.
     * $ketua true  -> jadikan ketua KBK tersebut (ketua lama di KBK itu diakhiri).
     * $ketua false -> anggota KBK tersebut (jabatan ketua di KBK itu dicabut).
     */
    public static function atur(int $userId, ?int $kbkId, bool $ketua): void
    {
        $today = now()->toDateString();

        DB::transaction(function () use ($userId, $kbkId, $ketua, $today) {
            $aktif = static::where('user_id', $userId)->whereNull('selesai');

            if (! $kbkId) {
                (clone $aktif)->update(['selesai' => $today]);
                DB::table('users')->where('id', $userId)->update(['kbk_id' => null]);
                return;
            }

            // Penugasan di KBK lain selalu diakhiri.
            (clone $aktif)->where('kbk_id', '!=', $kbkId)->update(['selesai' => $today]);

            if ($ketua) {
                // Ketua lama di KBK ini diakhiri, lalu peran anggota user di sini diganti ketua.
                static::where('kbk_id', $kbkId)->where('peran', 'ketua')
                    ->where('user_id', '!=', $userId)->whereNull('selesai')
                    ->update(['selesai' => $today]);
                (clone $aktif)->where('kbk_id', $kbkId)->where('peran', 'anggota')
                    ->update(['selesai' => $today]);
            } else {
                (clone $aktif)->where('kbk_id', $kbkId)->where('peran', 'ketua')
                    ->update(['selesai' => $today]);
            }

            $peran = $ketua ? 'ketua' : 'anggota';
            $sudahAda = static::where('user_id', $userId)->where('kbk_id', $kbkId)
                ->where('peran', $peran)->whereNull('selesai')->exists();

            if (! $sudahAda) {
                static::create([
                    'user_id' => $userId, 'kbk_id' => $kbkId, 'peran' => $peran,
                    'mulai' => $today, 'selesai' => null,
                ]);
            }

            DB::table('users')->where('id', $userId)->update(['kbk_id' => $kbkId]);
        });
    }
}
