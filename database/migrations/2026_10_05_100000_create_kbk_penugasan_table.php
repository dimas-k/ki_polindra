<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kbk_penugasan', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('kbk_id')->constrained('kelompok_keahlians')->cascadeOnDelete();
            $t->enum('peran', ['ketua', 'anggota']);
            $t->date('mulai');
            $t->date('selesai')->nullable();
            $t->timestamps();
            $t->index(['kbk_id', 'peran', 'selesai']);
        });

        $today = now()->toDateString();

        // Ketua KBK lama: satu ketua aktif per KBK (yang id-nya terbesar), sisanya diakhiri.
        $aktifPerKbk = [];
        $ketua = DB::table('users')->where('role', 'Ketua KBK')->whereNotNull('kbk_id')
            ->orderByDesc('id')->get(['id', 'kbk_id']);
        foreach ($ketua as $u) {
            $selesai = isset($aktifPerKbk[$u->kbk_id]) ? $today : null;
            $aktifPerKbk[$u->kbk_id] = true;
            DB::table('kbk_penugasan')->insert([
                'user_id' => $u->id, 'kbk_id' => $u->kbk_id, 'peran' => 'ketua',
                'mulai' => $today, 'selesai' => $selesai, 'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // Dosen yang sudah punya KBK menjadi anggota.
        DB::table('users')->where('role', 'Dosen')->whereNotNull('kbk_id')->get(['id', 'kbk_id'])
            ->each(function ($u) use ($today) {
                DB::table('kbk_penugasan')->insert([
                    'user_id' => $u->id, 'kbk_id' => $u->kbk_id, 'peran' => 'anggota',
                    'mulai' => $today, 'selesai' => null, 'created_at' => now(), 'updated_at' => now(),
                ]);
            });

        // Semua akun sekarang berstatus Dosen. Jabatan Ketua KBK ada di tabel penugasan.
        DB::table('users')->where('role', 'Ketua KBK')->update(['role' => 'Dosen']);
    }

    public function down(): void
    {
        DB::table('users')->whereIn('id', DB::table('kbk_penugasan')
            ->where('peran', 'ketua')->whereNull('selesai')->pluck('user_id'))
            ->update(['role' => 'Ketua KBK']);
        Schema::dropIfExists('kbk_penugasan');
    }
};
