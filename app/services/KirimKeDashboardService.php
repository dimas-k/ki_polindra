<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KirimKeDashboardService
{
    /**
     * Kirim satu record KI (paten/hak_cipta/desain_industri) ke tabel
     * 'produks' atau 'penelitians', dengan mapping field yang masuk akal
     * per jenis KI. Admin memilih tujuan & KBK secara manual (tidak ada
     * kolom kbk_id di tabel KI, jadi wajib dipilih saat pengiriman).
     *
     * CATATAN PENTING:
     * - 'gambar' diisi dari file bertipe gambar (jpg/jpeg/png) pertama di
     *   field gambar_paten/gambar_tampilan/gambar_di (field itu boleh banyak
     *   file: PDF + gambar). Kalau tidak ada file gambar, NULL -> dashboard
     *   memakai gambar gedung default.
     * - 'lampiran' diisi dari dokumen PDF asli (sertifikat kalau ada,
     *   fallback ke dokumen utama).
     * - Anggota (nama-nama di kolom "Nama" pada file Excel 'data_pengaju2')
     *   dicocokkan satu per satu dengan anggota KBK (tabel
     *   anggota_kelompok_keahlians) milik KBK tujuan ($kbkId):
     *     - Nama yang COCOK dengan anggota KBK -> dicatat sebagai "anggota
     *       inventor" terstruktur (baris baru di produks_anggotas /
     *       penelitians_anggotas, anggota_type = 'anggota_kelompok_keahlians'),
     *       sama seperti kalau Ketua KBK menambahkannya manual lewat UI.
     *     - Nama yang TIDAK cocok masuk ke field teks bebas
     *       anggota_inventor_lainnya / anggota_penulis_lainnya (mahasiswa/
     *       dosen/tendik terkait yang bukan anggota KBK), digabung koma
     *       seperti sebelumnya.
     *
     * @param  string  $jenisKi   'paten' | 'hak_cipta' | 'desain_industri'
     * @param  object  $record    record Eloquent/DB dari tabel KI terkait
     * @param  string  $tujuan    'produk' | 'penelitian'
     * @param  int     $kbkId     id kelompok_keahlians tujuan
     * @return int  id baris baru yang dibuat di produks/penelitians
     */
    public function kirim(string $jenisKi, object $record, string $tujuan, int $kbkId): int
    {
        $mapping = $this->mapping($jenisKi, $record);

        $namaList = $this->parseNamaListDariExcel($record->data_pengaju2 ?? null);
        $anggotaSplit = $this->splitAnggotaByKbk($namaList, $kbkId);
        $anggotaKbkIds = $anggotaSplit['matched'];
        $anggotaLainnya = empty($anggotaSplit['unmatched']) ? null : implode(', ', $anggotaSplit['unmatched']);

        if ($tujuan === 'produk') {
            $id = DB::table('produks')->insertGetId([
                'kbk_id' => $kbkId,
                'nama_produk' => $mapping['judul'],
                'deskripsi' => $mapping['deskripsi'],
                'gambar' => $mapping['gambar'],
                'inventor' => $mapping['nama_pengaju'],
                'anggota_inventor_lainnya' => $anggotaLainnya,
                'email_inventor' => $mapping['email'],
                'lampiran' => $mapping['lampiran'],
                'tanggal_submit' => $mapping['tanggal'],
                'status' => 'Belum Divalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ($anggotaKbkIds as $anggotaKbkId) {
                DB::table('produks_anggotas')->insert([
                    'produk_id' => $id,
                    'anggota_id' => $anggotaKbkId,
                    'anggota_type' => 'anggota_kelompok_keahlians',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        } elseif ($tujuan === 'penelitian') {
            $id = DB::table('penelitians')->insertGetId([
                'kbk_id' => $kbkId,
                'judul' => $mapping['judul'],
                'abstrak' => $mapping['deskripsi'],
                'gambar' => $mapping['gambar'],
                'penulis' => $mapping['nama_pengaju'],
                'anggota_penulis_lainnya' => $anggotaLainnya,
                'email_penulis' => $mapping['email'],
                'lampiran' => $mapping['lampiran'],
                'tanggal_publikasi' => $mapping['tanggal'],
                'status' => 'Belum Divalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ($anggotaKbkIds as $anggotaKbkId) {
                DB::table('penelitians_anggotas')->insert([
                    'penelitian_id' => $id,
                    'anggota_id' => $anggotaKbkId,
                    'anggota_type' => 'anggota_kelompok_keahlians',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        } else {
            throw new \InvalidArgumentException("Tujuan tidak valid: {$tujuan}");
        }

        // Tandai record KI supaya tidak dikirim dobel
        DB::table($jenisKi)->where('id', $record->id)->update([
            'dikirim_ke' => $tujuan,
            'updated_at' => Carbon::now(),
        ]);

        return $id;
    }

    /**
     * Cocokkan daftar nama (dari Excel 'data_pengaju2') dengan anggota KBK
     * tujuan (tabel anggota_kelompok_keahlians, difilter kbk_id).
     *
     * - Nama yang cocok (dibandingkan case-insensitive & spasi dirapikan)
     *   -> masuk 'matched' berisi id anggota_kelompok_keahlians, nantinya
     *   dicatat sebagai "anggota inventor" terstruktur.
     * - Nama yang tidak cocok -> masuk 'unmatched' apa adanya (teks),
     *   nantinya jadi anggota_inventor_lainnya / anggota_penulis_lainnya
     *   (mahasiswa/dosen/tendik terkait yang bukan anggota KBK).
     *
     * @return array{matched: int[], unmatched: string[]}
     */
    protected function splitAnggotaByKbk(array $namaList, int $kbkId): array
    {
        if (empty($namaList)) {
            return ['matched' => [], 'unmatched' => []];
        }

        $lookup = [];
        foreach (DB::table('anggota_kelompok_keahlians')->where('kbk_id', $kbkId)->get(['id', 'nama_lengkap']) as $anggotaKbk) {
            $lookup[$this->normalisasiNama($anggotaKbk->nama_lengkap)] = $anggotaKbk->id;
        }

        $matched = [];
        $unmatched = [];
        foreach ($namaList as $nama) {
            $key = $this->normalisasiNama($nama);
            if ($key !== '' && isset($lookup[$key])) {
                $matched[] = $lookup[$key];
            } else {
                $unmatched[] = $nama;
            }
        }

        return ['matched' => array_values(array_unique($matched)), 'unmatched' => $unmatched];
    }

    /**
     * Rapikan nama supaya perbandingan tidak terpengaruh beda kapitalisasi
     * atau spasi berlebih/ganda ("Budi  Santoso " vs "budi santoso").
     */
    protected function normalisasiNama(?string $nama): string
    {
        return preg_replace('/\s+/', ' ', strtolower(trim((string) $nama)));
    }

    /**
     * Baca file Excel 'data_pengaju2' (format: baris 1-5 header info,
     * baris 6 nama kolom "No., Nama, Email, No. Telpon, ...", baris 7+
     * data anggota), ambil kolom "Nama" saja sebagai daftar nama (array).
     * Kembalikan array kosong kalau file tidak ada / kosong / gagal dibaca
     * (tidak melempar exception supaya proses kirim tetap lanjut walau
     * file Excel bermasalah).
     *
     * @return string[]
     */
    protected function parseNamaListDariExcel(?string $relativePath): array
    {
        if (! $relativePath) {
            return [];
        }

        // File KI disimpan di disk 'public' atau 'private' tergantung jenisnya;
        // coba kedua kemungkinan lokasi fisik.
        $fullPath = Storage::disk('public')->exists($relativePath)
            ? Storage::disk('public')->path($relativePath)
            : (Storage::disk('private')->exists($relativePath)
                ? Storage::disk('private')->path($relativePath)
                : null);

        if (! $fullPath || ! file_exists($fullPath)) {
            return [];
        }

        try {
            $spreadsheet = IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, false);

            // Cari baris header ("No.", "Nama", "Email", ...) supaya
            // tidak hardcode nomor baris -- format file bisa sedikit beda.
            $headerRowIndex = null;
            foreach ($rows as $i => $row) {
                if (isset($row[1]) && trim((string) $row[1]) === 'Nama') {
                    $headerRowIndex = $i;
                    break;
                }
            }

            if ($headerRowIndex === null) {
                return [];
            }

            $namaList = [];
            for ($i = $headerRowIndex + 1; $i < count($rows); $i++) {
                $nama = trim((string) ($rows[$i][1] ?? ''));
                if ($nama !== '') {
                    $namaList[] = $nama;
                }
            }

            return $namaList;
        } catch (\Throwable $e) {
            // File korup / bukan xlsx valid / dsb -- jangan hentikan proses kirim
            return [];
        }
    }

    /**
     * Mapping field per jenis KI -> field generik (judul, deskripsi,
     * nama_pengaju, email, tanggal, lampiran).
     */
    protected function mapping(string $jenisKi, object $record): array
    {
        return match ($jenisKi) {
            'paten' => [
                'judul' => $record->judul_paten,
                'deskripsi' => $record->deskripsi_paten,
                'nama_pengaju' => $record->nama_lengkap,
                'email' => $record->email,
                'tanggal' => $record->tanggal_permohonan,
                'gambar' => \App\Support\MultiFileStorage::firstImage($record->gambar_tampilan) ?: ($record->gambar_img ?? null),
                'lampiran' => $record->sertifikat_paten ?: \App\Support\MultiFileStorage::firstDocument($record->gambar_paten),
            ],
            'hak_cipta' => [
                'judul' => $record->judul_ciptaan,
                'deskripsi' => $record->uraian_singkat,
                'nama_pengaju' => $record->nama_lengkap,
                'email' => $record->email,
                'tanggal' => $record->tanggal_permohonan,
                'gambar' => \App\Support\MultiFileStorage::firstImage($record->gambar_ciptaan ?? null) ?: ($record->gambar_img ?? null),
                'lampiran' => $record->sertifikat_hakcipta ?: $record->dokumen_invensi,
            ],
            'desain_industri' => [
                'judul' => $record->judul_di,
                'deskripsi' => $record->uraian_di,
                'nama_pengaju' => $record->nama_lengkap,
                'email' => $record->email,
                'tanggal' => $record->tanggal_permohonan,
                'gambar' => \App\Support\MultiFileStorage::firstImage($record->gambar_di) ?: ($record->gambar_img ?? null),
                'lampiran' => $record->sertifikat_desain ?: \App\Support\MultiFileStorage::firstDocument($record->gambar_di),
            ],
            default => throw new \InvalidArgumentException("Jenis KI tidak dikenal: {$jenisKi}"),
        };
    }
}