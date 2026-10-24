<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota_kelompok_keahlians', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->foreignId('kbk_id')->constrained('kelompok_keahlians')->onDelete('cascade'); // Relasi ke kelompok keahlian
            $table->string('nama_lengkap'); 
            $table->string('jabatan')->nullable(); 
            $table->string('email')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_kelompok_keahlians');
    }
};
