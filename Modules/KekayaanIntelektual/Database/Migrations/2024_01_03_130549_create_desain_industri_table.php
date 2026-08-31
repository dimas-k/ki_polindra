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
        Schema::create('desain_industri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('cek_id')->constrained('check_di')->nullable();
            $table->string('nama_lengkap');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->date('tanggal_lahir');
            $table->string('ktp_inventor');
            $table->string('email');
            $table->string('kewarganegaraan');
            $table->integer('kode_pos');
            $table->string('institusi');
            $table->string('data_pengaju2')->nullable();
            $table->string('jurusan')->default('tidak ada');
            $table->string('prodi')->default('tidak ada');
            $table->string('jenis_di');
            $table->string('judul_di');
            $table->string('uraian_di');
            $table->string('gambar_di');
            $table->string('surat_kepemilikan');
            $table->string('surat_pengalihan');
            $table->date('tanggal_permohonan');
            $table->string('status')->default('Menunggu Verifikasi Data Oleh Verifikator');
            $table->string('sertifikat_desain')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desain_industri');
    }
};
