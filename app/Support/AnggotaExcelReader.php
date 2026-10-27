<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Helper untuk membaca isi file Excel 'data_pengaju2' (data anggota
 * inventor / penulis / pendesain lainnya) supaya bisa ditampilkan
 * sebagai tabel di halaman detail (show) milik Admin, Verifikator
 * (Checker), dan Dosen.
 *
 * Format file (sesuai template upload): beberapa baris di atas berisi
 * info/judul, lalu ada baris header kolom yang salah satu selnya
 * bertuliskan "Nama", baru setelah itu baris-baris data.
 */
class AnggotaExcelReader
{
    /**
     * Baca file Excel dan kembalikan ['headers' => [...], 'rows' => [[...], ...]].
     * Kembalikan null kalau file tidak ada / kosong / gagal dibaca, supaya
     * view tinggal cek null untuk menyembunyikan tabel.
     */
    public static function read(?string $relativePath): ?array
    {
        if (! $relativePath) {
            return null;
        }

        $fullPath = Storage::disk('public')->exists($relativePath)
            ? Storage::disk('public')->path($relativePath)
            : (Storage::disk('private')->exists($relativePath)
                ? Storage::disk('private')->path($relativePath)
                : null);

        if (! $fullPath || ! file_exists($fullPath)) {
            return null;
        }

        try {
            $spreadsheet = IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, false);

            // Cari baris header: baris yang punya sel berisi "Nama".
            $headerRowIndex = null;
            foreach ($rows as $i => $row) {
                foreach ($row as $cell) {
                    if (trim((string) $cell) === 'Nama') {
                        $headerRowIndex = $i;
                        break 2;
                    }
                }
            }

            if ($headerRowIndex === null) {
                return null;
            }

            // Ambil label kolom dari baris header (buang kolom kosong di ujung).
            $headerRow = $rows[$headerRowIndex];
            $headers = [];
            foreach ($headerRow as $cell) {
                $headers[] = trim((string) $cell);
            }
            while (! empty($headers) && end($headers) === '') {
                array_pop($headers);
            }

            if (empty($headers)) {
                return null;
            }

            $colCount = count($headers);
            $dataRows = [];
            for ($i = $headerRowIndex + 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $values = [];
                for ($c = 0; $c < $colCount; $c++) {
                    $values[] = trim((string) ($row[$c] ?? ''));
                }
                // Lewati baris yang semua selnya kosong.
                if (implode('', $values) === '') {
                    continue;
                }
                $dataRows[] = $values;
            }

            if (empty($dataRows)) {
                return null;
            }

            return [
                'headers' => $headers,
                'rows' => $dataRows,
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }
}
