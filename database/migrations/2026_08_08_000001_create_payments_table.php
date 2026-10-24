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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Relasi polymorphic ke Paten, HakCipta, atau DesainIndustri
            $table->morphs('payable'); // payable_id, payable_type

            $table->foreignId('user_id')->constrained('users');

            // ID unik yang dikirim ke Midtrans (order_id)
            $table->string('order_id')->unique();

            $table->string('deskripsi')->nullable();
            $table->unsignedBigInteger('nominal');

            // Menunggu Pembayaran | Dibayar | Kadaluarsa | Dibatalkan
            $table->string('status')->default('Menunggu Pembayaran');

            $table->timestamp('tenggat_pembayaran');
            $table->timestamp('paid_at')->nullable();
            $table->boolean('reminder_terkirim')->default(false);

            // Data dari Midtrans
            $table->string('snap_token')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->json('raw_response')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
