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
        Schema::create('check_hc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('hak_cipta_id')->constrained('hak_cipta')->onDelete('cascade');
            $table->enum('cek_data',['Valid','Tidak Valid','Menunggu Pemeriksaan'])->default('Menunggu Pemeriksaan');
            $table->string('keterangan')->default('Data Hak Cipta Belum Dicek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_hc');
    }
};
