<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan dukungan metode pembayaran manual (transfer/VA/QRIS
     * yang dikelola admin) sebagai alternatif Midtrans Snap.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // midtrans | manual
            $table->string('tipe_pembayaran')->default('midtrans')->after('order_id');

            $table->foreignId('bank_account_id')
                ->nullable()
                ->after('tipe_pembayaran')
                ->constrained('payment_bank_accounts')
                ->nullOnDelete();

            // Bukti transfer yang diunggah pengaju (disk "local", privat)
            $table->string('bukti_pembayaran')->nullable()->after('raw_response');

            $table->foreignId('verified_by')
                ->nullable()
                ->after('bukti_pembayaran')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable()->after('verified_by');
            $table->text('catatan_verifikasi')->nullable()->after('verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('bank_account_id');
            $table->dropConstrainedForeignId('verified_by');
            $table->dropColumn([
                'tipe_pembayaran',
                'bukti_pembayaran',
                'verified_at',
                'catatan_verifikasi',
            ]);
        });
    }
};
