<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['paten', 'hak_cipta', 'desain_industri'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->string('gambar_img')->nullable()->after('status');
            });
        }
    }

    public function down(): void
    {
        foreach (['paten', 'hak_cipta', 'desain_industri'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropColumn('gambar_img');
            });
        }
    }
};
