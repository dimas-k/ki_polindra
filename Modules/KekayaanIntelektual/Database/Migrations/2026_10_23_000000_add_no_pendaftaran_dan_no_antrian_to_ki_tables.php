<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Tambah No Pendaftaran & No Antrian
|--------------------------------------------------------------------------
| Diminta admin: field ini diisi manual oleh Admin di form edit setelah
| pengajuan diproses, jadi nullable (belum tentu ada saat data dibuat).
| - paten            : no_pendaftaran + no_antrian
| - hak_cipta        : no_pendaftaran saja (tidak ada no antrian di hak cipta)
| - desain_industri  : no_pendaftaran + no_antrian
*/
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paten', function (Blueprint $table) {
            $table->string('no_pendaftaran')->nullable()->after('jenis_paten');
            $table->string('no_antrian')->nullable()->after('no_pendaftaran');
        });

        Schema::table('hak_cipta', function (Blueprint $table) {
            $table->string('no_pendaftaran')->nullable()->after('jenis_ciptaan');
        });

        Schema::table('desain_industri', function (Blueprint $table) {
            $table->string('no_pendaftaran')->nullable()->after('jenis_di');
            $table->string('no_antrian')->nullable()->after('no_pendaftaran');
        });
    }

    public function down(): void
    {
        Schema::table('paten', function (Blueprint $table) {
            $table->dropColumn(['no_pendaftaran', 'no_antrian']);
        });

        Schema::table('hak_cipta', function (Blueprint $table) {
            $table->dropColumn('no_pendaftaran');
        });

        Schema::table('desain_industri', function (Blueprint $table) {
            $table->dropColumn(['no_pendaftaran', 'no_antrian']);
        });
    }
};
