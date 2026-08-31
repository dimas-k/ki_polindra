<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kbk_id')->nullable()->constrained('kelompok_keahlians');
            $table->string('judul');
            $table->text('abstrak');
            $table->string('gambar')->nullable();
            $table->string('penulis')->nullable();
            $table->string('penulis_lainnya')->nullable();
            $table->string('email_penulis');
            $table->string('penulis_korespondensi')->nullable();
            $table->text('anggota_penulis_lainnya')->nullable();
            $table->text('lampiran')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->string('status')->default('Belum Divalidasi');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitians');
    }
};
