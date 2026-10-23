<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar rekening/kanal pembayaran manual yang dikelola admin
     * (Transfer Bank, Virtual Account, QRIS), sebagai alternatif
     * dari Midtrans Snap yang memotong biaya layanan/pajak.
     */
    public function up(): void
    {
        Schema::create('payment_bank_accounts', function (Blueprint $table) {
            $table->id();

            // transfer_manual | virtual_account | qris
            $table->string('tipe')->default('transfer_manual');

            $table->string('nama_bank');              // "Bank BRI", "Bank Mandiri", "QRIS", dst.
            $table->string('nomor_rekening')->nullable();   // no. rekening / nomor VA
            $table->string('atas_nama')->nullable();        // nama pemilik rekening
            $table->string('kode_bank')->nullable();        // kode bank untuk VA (mis. 002, 008)
            $table->string('logo')->nullable();             // path logo bank, disk "public"
            $table->string('qris_image')->nullable();       // path gambar QRIS, disk "public"
            $table->text('catatan')->nullable();             // instruksi tambahan untuk pengaju
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);  // tampil default di halaman pembayaran
            $table->unsignedInteger('urutan')->default(0);  // urutan tampil

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_bank_accounts');
    }
};
