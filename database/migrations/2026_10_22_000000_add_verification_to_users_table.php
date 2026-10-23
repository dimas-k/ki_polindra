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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false)->after('role');
            $table->timestamp('verified_at')->nullable()->after('is_verified');
        });

        // Akun yang sudah ada sebelum fitur ini dibuat dianggap sudah terverifikasi,
        // supaya mereka tidak terkunci keluar dari sistem.
        \Illuminate\Support\Facades\DB::table('users')->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_verified', 'verified_at']);
        });
    }
};
