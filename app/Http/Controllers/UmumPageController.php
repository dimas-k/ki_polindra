<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paten;
use App\Models\HakCipta;
use App\Models\DesainIndustri;
use App\Models\Jurusan;

class UmumPageController extends Controller
{
    public function index(Request $request)
    {
        $paten = Paten::all()->count();
        $di = DesainIndustri::all()->count();
        $hc = HakCipta::all()->count();

        $contohPaten = Paten::where('status', 'Diberi')->count();
        $contohDi = DesainIndustri::where('status', 'Diberi')->count();
        $contohHc = HakCipta::where('status', 'Tercatat')->count();

        // Daftar jurusan untuk filter diagram Kekayaan Intelektual per Jurusan.
        // Default (tanpa pilihan) tetap menampilkan data seluruh jurusan seperti semula.
        $jurusanList = Jurusan::orderBy('nama_jurusan')->get();
        $jurusanId = $request->get('jurusan');
        $jurusanTerpilih = $jurusanId ? Jurusan::find($jurusanId) : null;

        $filterJurusan = function ($query) use ($jurusanTerpilih) {
            if ($jurusanTerpilih) {
                $query->whereRaw('LOWER(TRIM(jurusan)) = ?', [strtolower(trim($jurusanTerpilih->nama_jurusan))]);
            }
        };

        $data_paten = Paten::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
            ->when($jurusanTerpilih, $filterJurusan)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        // Data untuk Hak Cipta
        $data_hakCipta = HakCipta::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
            ->when($jurusanTerpilih, $filterJurusan)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();


        // Data untuk Desain Industri
        $data_desainIndustri = DesainIndustri::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
            ->when($jurusanTerpilih, $filterJurusan)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $tahun = $data_paten->pluck('tahun')
            ->merge($data_hakCipta->pluck('tahun'))
            ->merge($data_desainIndustri->pluck('tahun'))
            ->unique()
            ->sort()
            ->values();

        // Sesuaikan data agar semua tahun memiliki nilai (0 jika tidak ada data)
        $data_paten_per_tahun = $tahun->map(function ($thn) use ($data_paten) {
            return $data_paten->firstWhere('tahun', $thn)->jumlah ?? 0;
        });
        $data_hakCipta_per_tahun = $tahun->map(function ($thn) use ($data_hakCipta) {
            return $data_hakCipta->firstWhere('tahun', $thn)->jumlah ?? 0;
        });
        $data_desainIndustri_per_tahun = $tahun->map(function ($thn) use ($data_desainIndustri) {
            return $data_desainIndustri->firstWhere('tahun', $thn)->jumlah ?? 0;
        });

        // $jurusan_Ti_Paten = Paten::where('jurusan', 'Teknik Informatika')->count();

        return view('umum-page.landing-page.index', compact(
            'contohPaten',
            'contohDi',
            'contohHc',
            'paten',
            'di',
            'hc',
            'data_paten',
            'data_hakCipta',
            'data_desainIndustri',
            'tahun',
            'data_paten_per_tahun',
            'data_hakCipta_per_tahun',
            'data_desainIndustri_per_tahun',
            'jurusanList',
            'jurusanTerpilih'
        ));
    }
}
