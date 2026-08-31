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
        Schema::create('penelitians_anggotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('penelitian_id')->constrained('penelitians')->onDelete('cascade');
            $table->unsignedBigInteger('anggota_id');
            $table->string('anggota_type'); // Menyimpan tipe anggota
            $table->timestamps();
        
            // Tetap gunakan foreign key untuk penelitian_id
            // $table->foreign('penelitian_id')->references('id')->on('penelitians')->onDelete('cascade');
            // $table->index(['anggota_id', 'anggota_type']);

        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitians_anggotas');
    }
};
