<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KbkSeeder extends Seeder
{
    /**
     * Seed master data Kelompok Bidang Keahlian (KBK).
     * Data sama dipakai baik oleh KI maupun Dashboard Produk Inovasi.
     */
    public function run(): void
    {
        DB::table('kelompok_keahlians')->insert([
            ['nama_kbk' => 'Sistem Informasi', 'jurusan' => 'Teknik Informatika', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Rekayasa Perangkat Lunak dan Pengetahuan', 'jurusan' => 'Teknik Informatika', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Sistem Komputer dan Jaringan', 'jurusan' => 'Teknik Informatika', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Sains Data', 'jurusan' => 'Teknik Informatika', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Fundamental And Management Nursing', 'jurusan' => 'Keperawatan', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Clinical Care Nursing', 'jurusan' => 'Keperawatan', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Mental Health And Community Nursing', 'jurusan' => 'Keperawatan', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Perancangan Manufaktur', 'jurusan' => 'Teknik Mesin', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Rekayasa Material', 'jurusan' => 'Teknik Mesin', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'RHVAC', 'jurusan' => 'Teknik Pendingin dan Tata Udara', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_kbk' => 'Instrumentasi dan Kontrol', 'jurusan' => 'Teknik Pendingin dan Tata Udara', 'deskripsi' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
