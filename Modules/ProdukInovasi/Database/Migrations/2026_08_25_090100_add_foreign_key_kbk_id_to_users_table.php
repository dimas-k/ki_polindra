<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Susulan dari migration Fase 1 (add_dashboard_produk_fields_to_users_table)
     * yang menambahkan kolom users.kbk_id TANPA foreign key constraint,
     * karena waktu itu tabel kelompok_keahlians belum ada di database SIKI.
     *
     * Sekarang tabel kelompok_keahlians sudah dipindahkan (Modul ProdukInovasi),
     * jadi constraint-nya bisa dipasang, sesuai desain asli Dashboard Produk.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('kbk_id')->references('id')->on('kelompok_keahlians')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kbk_id']);
        });
    }
};
