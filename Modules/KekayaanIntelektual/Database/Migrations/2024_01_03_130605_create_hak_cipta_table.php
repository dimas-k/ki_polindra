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
        Schema::create('hak_cipta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('cek_id')->constrained('check_hc')->nullable();
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
            $table->string('jenis_ciptaan');
            $table->string('judul_ciptaan');
            $table->text('uraian_singkat');
            $table->string('dokumen_invensi');
            $table->string('surat_pengalihan');
            $table->string('surat_pernyataan');
            $table->date('tanggal_permohonan');
            $table->string('status')->default('Menunggu Verifikasi Data Oleh Verifikator');
            $table->string('sertifikat_hakcipta')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hak_cipta');
    }
};
