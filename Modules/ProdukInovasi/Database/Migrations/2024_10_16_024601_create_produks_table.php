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
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kbk_id')->nullable()->constrained('kelompok_keahlians');
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->string('inventor')->nullable();
            $table->string('inventor_lainnya')->nullable();
            $table->text('anggota_inventor_lainnya')->nullable();
            $table->string('email_inventor');
            $table->text('lampiran')->nullable();
            $table->date('tanggal_submit')->nullable();
            $table->date('tanggal_granted')->nullable();
            $table->string('status')->default('Belum Divalidasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
