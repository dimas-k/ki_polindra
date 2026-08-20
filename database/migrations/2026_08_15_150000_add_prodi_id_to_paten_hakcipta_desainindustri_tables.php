<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected array $tables = ['paten', 'hak_cipta', 'desain_industri'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah kolom prodi_id (nullable) ke masing-masing tabel.
        //    Kolom 'jurusan' dan 'prodi' (string) TIDAK dihapus, supaya data lama
        //    tetap tampil apa adanya walau tidak ketemu padanannya di tabel prodi.
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (!Schema::hasColumn($table, 'prodi_id')) {
                    $blueprint->unsignedBigInteger('prodi_id')->nullable()->after('id');
                    $blueprint->foreign('prodi_id')->references('id')->on('prodi')->nullOnDelete();
                }
            });
        }

        // 2. Backfill: cocokkan teks kolom 'prodi' yang sudah tersimpan
        //    dengan nama_prodi di tabel prodi (dibandingkan tanpa peduli
        //    besar/kecil huruf dan spasi berlebih), lalu isi prodi_id.
        $prodiList = DB::table('prodi')->get(['id', 'nama_prodi']);

        foreach ($this->tables as $table) {
            $rows = DB::table($table)->select('id', 'prodi')->whereNull('prodi_id')->get();

            foreach ($rows as $row) {
                if (empty($row->prodi)) {
                    continue;
                }

                $target = strtolower(trim($row->prodi));

                $match = $prodiList->first(function ($p) use ($target) {
                    return strtolower(trim($p->nama_prodi)) === $target;
                });

                if ($match) {
                    DB::table($table)->where('id', $row->id)->update(['prodi_id' => $match->id]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (Schema::hasColumn($table, 'prodi_id')) {
                    $blueprint->dropForeign([$table . '_prodi_id_foreign']);
                    $blueprint->dropColumn('prodi_id');
                }
            });
        }
    }
};
