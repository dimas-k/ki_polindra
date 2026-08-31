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
        Schema::create('produks_anggotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->unsignedBigInteger('anggota_id'); // Tidak perlu foreignId karena polymorphic
            $table->string('anggota_type'); // Menyimpan tipe relasi (users atau anggota_kelompok_keahlians)
            $table->timestamps();
            
            // Menambahkan index untuk optimasi pencarian
            $table->index(['anggota_id', 'anggota_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks_anggotas');
    }
};

