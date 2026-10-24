<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * gambar_paten & gambar_tampilan (tabel paten) dan gambar_di (tabel
 * desain_industri) tadinya cuma kolom string berisi SATU path file.
 * Sekarang satu input boleh diisi lebih dari satu file (PDF dan/atau
 * gambar sekaligus), jadi kolomnya diperbesar jadi TEXT dan isinya
 * berupa JSON array of path, contoh: ["dokumen-paten/a.pdf","dokumen-paten/b.jpg"]
 *
 * Data lama (yang masih berupa satu path string biasa) tetap bisa
 * dibaca oleh helper MultiFileStorage::decode() di app/Support — jadi
 * migration ini aman untuk data yang sudah ada, tidak perlu diubah manual.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Pakai raw SQL (bukan ->change()) karena project ini tidak
        // menginstall doctrine/dbal, dan Laravel 11 masih butuh paket
        // itu untuk method ->change() pada MySQL.
        DB::statement('ALTER TABLE paten MODIFY gambar_paten TEXT NOT NULL');
        DB::statement('ALTER TABLE paten MODIFY gambar_tampilan TEXT NOT NULL');
        DB::statement('ALTER TABLE desain_industri MODIFY gambar_di TEXT NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE paten MODIFY gambar_paten VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE paten MODIFY gambar_tampilan VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE desain_industri MODIFY gambar_di VARCHAR(255) NOT NULL');
    }
};
