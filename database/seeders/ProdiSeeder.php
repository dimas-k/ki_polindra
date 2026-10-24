<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil id jurusan berdasarkan kode_jurusan (dari JurusanSeeder)
        $jurusanId = DB::table('jurusan')->pluck('id', 'kode_jurusan');

        DB::table('prodi')->insert([
            [
                'jurusan_id' => $jurusanId['ti'] ?? null,
                'nama_prodi' => 'D3 Teknik Informatika',
                'kode_prodi' => 'd3ti'
            ],
            [
                'jurusan_id' => $jurusanId['ti'] ?? null,
                'nama_prodi' => 'D4 Rekayasa Perangkat Lunak',
                'kode_prodi' => 'd4rpl'
            ],
            [
                'jurusan_id' => $jurusanId['ti'] ?? null,
                'nama_prodi' => 'D4 Sistem Informasi Kota Cerdas',
                'kode_prodi' => 'd4sikc'
            ],
            [
                'jurusan_id' => $jurusanId['tm'] ?? null,
                'nama_prodi' => 'D3 Teknik Mesin',
                'kode_prodi' => 'd3tm'
            ],
            [
                'jurusan_id' => $jurusanId['tm'] ?? null,
                'nama_prodi' => 'D4 Perancangan Manufaktur',
                'kode_prodi' => 'd3pm'
            ],
            [
                'jurusan_id' => $jurusanId['tp'] ?? null,
                'nama_prodi' => 'D3 Teknik Pendingin dan Tata Udara',
                'kode_prodi' => 'd3tp'
            ],
            [
                'jurusan_id' => $jurusanId['tp'] ?? null,
                'nama_prodi' => 'D4 Teknik instrumentasi Kontrol',
                'kode_prodi' => 'd4trik'
            ],
            [
                'jurusan_id' => $jurusanId['kp'] ?? null,
                'nama_prodi' => 'D3 Keperawatan',
                'kode_prodi' => 'd3kp'
            ]
        ]);
    }
}
