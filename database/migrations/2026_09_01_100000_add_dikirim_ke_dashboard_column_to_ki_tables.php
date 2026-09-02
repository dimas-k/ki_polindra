<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menandai apakah data paten/hak_cipta/desain_industri sudah
     * dikirim ke Dashboard Produk Inovasi (sebagai produk atau
     * penelitian), supaya tidak terkirim dobel.
     */
    public function up(): void
    {
        foreach (['paten', 'hak_cipta', 'desain_industri'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->string('dikirim_ke')->nullable()->after('status'); // null | 'produk' | 'penelitian'
            });
        }
    }

    public function down(): void
    {
        foreach (['paten', 'hak_cipta', 'desain_industri'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropColumn('dikirim_ke');
            });
        }
    }
};
