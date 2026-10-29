<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\Produk;
use Modules\ProdukInovasi\app\Models\Penelitian;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

        // Cek apakah pengguna ingin mengunduh laporan sebagai file Excel (.xlsx)
        if ($request->has('download') && $request->input('download') == 'Excel') {
            return $this->downloadExcel($produk, $penelitian);
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
     * Unduh laporan Produk & Penelitian sebagai file Excel asli (.xlsx),
     * 2 sheet ('Produk' dan 'Penelitian'). Dipakai PhpSpreadsheet, package
     * yang sudah jadi dependency project ini (dipakai juga oleh
     * AnggotaExcelReader / KirimKeDashboardService), jadi tidak perlu
     * tambah dependency composer baru.
     */
    protected function downloadExcel($produk, $penelitian)
    {
        $produk = $produk->sortBy('nama_produk')->values();
        $penelitian = $penelitian->sortBy('judul')->values();

        $spreadsheet = new Spreadsheet();

        // ===== Sheet 1: Produk =====
        $sheetProduk = $spreadsheet->getActiveSheet();
        $sheetProduk->setTitle('Produk');

        $headerProduk = ['No', 'No Id', 'Nama KBK', 'Nama Produk', 'Inventor', 'Tanggal Submit', 'Tanggal Granted', 'Status'];
        $sheetProduk->fromArray($headerProduk, null, 'A1');
        $this->styleHeaderRow($sheetProduk, count($headerProduk));

        $row = 2;
        $no = 1;
        foreach ($produk as $item) {
            $inventor = $item->inventor ?: $item->inventor_lainnya;
            $sheetProduk->fromArray([
                $no++,
                $item->id,
                $item->kelompokKeahlian->nama_kbk ?? '-',
                $item->nama_produk,
                $inventor,
                $item->tanggal_submit ? Carbon::parse($item->tanggal_submit)->format('d-m-Y') : '-',
                $item->tanggal_granted ? Carbon::parse($item->tanggal_granted)->format('d-m-Y') : '-',
                $item->status,
            ], null, 'A' . $row);
            $row++;
        }

        $this->autosizeColumns($sheetProduk, count($headerProduk));

        // ===== Sheet 2: Penelitian =====
        $sheetPenelitian = $spreadsheet->createSheet();
        $sheetPenelitian->setTitle('Penelitian');

        $headerPenelitian = ['No', 'No Id', 'Nama KBK', 'Judul Penelitian', 'Penulis', 'Penulis Korespondensi', 'Tanggal Publikasi', 'Status'];
        $sheetPenelitian->fromArray($headerPenelitian, null, 'A1');
        $this->styleHeaderRow($sheetPenelitian, count($headerPenelitian));

        $row = 2;
        $no = 1;
        foreach ($penelitian as $item) {
            $penulis = $item->penulis ?: $item->penulis_lainnya;
            $sheetPenelitian->fromArray([
                $no++,
                $item->id,
                $item->kelompokKeahlian->nama_kbk ?? '-',
                $item->judul,
                $penulis,
                $item->penulis_korespondensi,
                $item->tanggal_publikasi ? Carbon::parse($item->tanggal_publikasi)->format('d-m-Y') : '-',
                $item->status,
            ], null, 'A' . $row);
            $row++;
        }

        $this->autosizeColumns($sheetPenelitian, count($headerPenelitian));

        // Tampilkan sheet Produk duluan saat file dibuka
        $spreadsheet->setActiveSheetIndex(0);

        $filename = 'report_' . now()->format('YmdHis') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Beri header row bold + background abu-abu + border tipis, supaya
     * file Excel yang diunduh lebih enak dibaca (bukan sekadar data polos).
     */
    protected function styleHeaderRow($sheet, int $columnCount): void
    {
        $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);
        $range = "A1:{$lastColumn}1";

        $sheet->getStyle($range)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9'],
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);
    }

    /**
     * Lebarkan kolom otomatis mengikuti isinya supaya tidak perlu
     * di-resize manual sehabis dibuka di Excel.
     */
    protected function autosizeColumns($sheet, int $columnCount): void
    {
        for ($i = 1; $i <= $columnCount; $i++) {
            $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
