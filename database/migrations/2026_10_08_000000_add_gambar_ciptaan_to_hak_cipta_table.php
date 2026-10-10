<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Gambar ciptaan: boleh banyak file (PDF dan/atau jpg/jpeg/png),
        // disimpan sebagai JSON array of path (lihat App\Support\MultiFileStorage).
        Schema::table('hak_cipta', function (Blueprint $table) {
            $table->text('gambar_ciptaan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('hak_cipta', function (Blueprint $table) {
            $table->dropColumn('gambar_ciptaan');
        });
    }
};
