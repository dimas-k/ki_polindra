<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\Produk;
use Modules\ProdukInovasi\app\Models\Penelitian;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Carbon\Carbon;

/**
 * Dashboard/Laporan admin Produk Inovasi.
 *
 * Diadaptasi dari AdminController@dashboard milik aplikasi
 * dashboard_produk_inovasi_polindra (sebelum digabung ke SIKI Polindra),
 * disesuaikan dengan model & namespace modul ProdukInovasi.
 */
class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $prdk_valid = Produk::where('status', 'Tervalidasi')->count();
        $prdk_nonvalid = Produk::where('status', 'Belum Divalidasi')->count();

        $pnltan_valid = Penelitian::where('status', 'Tervalidasi')->count();
        $pnltan_nonvalid = Penelitian::where('status', 'Belum Divalidasi')->count();

        $prdk_tahun = Produk::whereNotNull('tanggal_granted')
            ->where('status', 'Tervalidasi')
            ->get()
            ->groupBy(function ($item) {
                return $item->tanggal_granted->format('Y');
            })
            ->map(function ($group) {
                return $group->count();
            })->sortKeys();

        $plt_tahun = Penelitian::whereNotNull('tanggal_publikasi')
            ->where('status', 'Tervalidasi')
            ->get()
            ->groupBy(function ($item) {
                return $item->tanggal_publikasi->format('Y');
            })
            ->map(function ($group) {
                return $group->count();
            })->sortKeys();

        $queryProduk = Produk::query();
        $queryPenelitian = Penelitian::query();

        // Filter berdasarkan tahun
        if ($request->has('tahun_awal') && $request->has('tahun_akhir')) {
            $tahun_awal = $request->input('tahun_awal');
            $tahun_akhir = $request->input('tahun_akhir');

            if ($tahun_awal && $tahun_akhir) {
                $queryProduk->whereYear('tanggal_granted', '>=', $tahun_awal)
                    ->whereYear('tanggal_granted', '<=', $tahun_akhir);

                $queryPenelitian->whereYear('tanggal_publikasi', '>=', $tahun_awal)
                    ->whereYear('tanggal_publikasi', '<=', $tahun_akhir);
            }
        } elseif ($request->has('tahun_awal')) {
            $tahun_awal = $request->input('tahun_awal');

            $queryProduk->whereYear('tanggal_granted', '>=', $tahun_awal);
            $queryPenelitian->whereYear('tanggal_publikasi', '>=', $tahun_awal);
        } elseif ($request->has('tahun_akhir')) {
            $tahun_akhir = $request->input('tahun_akhir');

            $queryProduk->whereYear('tanggal_granted', '<=', $tahun_akhir);
            $queryPenelitian->whereYear('tanggal_publikasi', '<=', $tahun_akhir);
        }

        // Filter berdasarkan status validasi
        if ($request->has('status_validasi') && $request->status_validasi != '') {
            $status_validasi = $request->input('status_validasi');
            $queryProduk->where('status', $status_validasi);
            $queryPenelitian->where('status', $status_validasi);
        }

        $produk_paginate = $queryProduk->paginate(5);
        $penelitian_paginate = $queryPenelitian->paginate(5);
        $produk = $queryProduk->get();
        $penelitian = $queryPenelitian->get();

        // Cek apakah pengguna ingin mengunduh laporan (CSV, bisa dibuka langsung di Excel)
        if ($request->has('download') && $request->input('download') == 'Excel') {
            return $this->downloadCsv($produk, $penelitian);
        }

        return view('produkinovasi::admin.dashboard.index', compact(
            'pnltan_valid',
            'pnltan_nonvalid',
            'prdk_valid',
            'prdk_nonvalid',
            'prdk_tahun',
            'plt_tahun',
            'produk',
            'penelitian',
            'produk_paginate',
            'penelitian_paginate'
        ));
    }

    /**
     * Unduh laporan Produk & Penelitian sebagai CSV (bisa langsung dibuka
     * di Excel). Tidak memakai package Excel tambahan supaya tidak perlu
     * dependency composer baru di project gabungan ini.
     */
    protected function downloadCsv($produk, $penelitian)
    {
        $filename = 'report_' . now()->format('YmdHis') . '.csv';

        $produk = $produk->sortBy('nama_produk');
        $penelitian = $penelitian->sortBy('judul');

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($produk, $penelitian) {
            $out = fopen('php://output', 'w');

            // BOM supaya karakter non-ASCII tampil benar saat dibuka di Excel
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, ['Produk']);
            fputcsv($out, ['No', 'No Id', 'Nama KBK', 'Nama Produk', 'Inventor', 'Tanggal Submit', 'Tanggal Granted', 'Status']);

            $no = 1;
            foreach ($produk as $item) {
                $inventor = $item->inventor ?: $item->inventor_lainnya;
                fputcsv($out, [
                    $no++,
                    $item->id,
                    $item->kelompokKeahlian->nama_kbk ?? '-',
                    $item->nama_produk,
                    $inventor,
                    $item->tanggal_submit ? Carbon::parse($item->tanggal_submit)->format('d-m-Y') : '-',
                    $item->tanggal_granted ? Carbon::parse($item->tanggal_granted)->format('d-m-Y') : '-',
                    $item->status,
                ]);
            }

            fputcsv($out, []);
            fputcsv($out, ['Penelitian']);
            fputcsv($out, ['No', 'No Id', 'Nama KBK', 'Judul Penelitian', 'Penulis', 'Penulis Korespondensi', 'Tanggal Publikasi', 'Status']);

            $no = 1;
            foreach ($penelitian as $item) {
                $penulis = $item->penulis ?: $item->penulis_lainnya;
                fputcsv($out, [
                    $no++,
                    $item->id,
                    $item->kelompokKeahlian->nama_kbk ?? '-',
                    $item->judul,
                    $penulis,
                    $item->penulis_korespondensi,
                    $item->tanggal_publikasi ? Carbon::parse($item->tanggal_publikasi)->format('d-m-Y') : '-',
                    $item->status,
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
