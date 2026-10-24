<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rekonstruksi migration Fase 1 yang hilang saat integrasi
     * project KI + Dashboard Produk Inovasi.
     * Menambahkan kolom yang dipakai fitur Dashboard Produk
     * ke tabel users, TANPA foreign key constraint dulu
     * (constraint kbk_id dipasang belakangan di migration
     * add_foreign_key_kbk_id_to_users_table setelah tabel
     * kelompok_keahlians tersedia).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ktp')->nullable()->after('alamat');
            $table->string('pas_foto')->nullable()->after('nip');
            $table->unsignedBigInteger('kbk_id')->nullable()->after('pas_foto');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ktp', 'pas_foto', 'kbk_id']);
        });
    }
};
