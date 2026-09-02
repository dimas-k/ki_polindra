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
     * - 'gambar' selalu NULL saat dikirim dari KI (semua file gambar_paten/
     *   gambar_di di data KI sebenarnya PDF, bukan JPG/PNG). Tampilan
     *   dashboard sudah diberi fallback gambar gedung kalau gambar NULL.
     * - 'lampiran' diisi dari dokumen PDF asli (sertifikat kalau ada,
     *   fallback ke dokumen utama).
     * - 'anggota' (anggota_inventor_lainnya / anggota_penulis_lainnya)
     *   di-parse otomatis dari file Excel 'data_pengaju2' (kolom "Nama"),
     *   digabung jadi satu string dipisah koma -- sesuai format yang
     *   dipakai dashboard untuk field ini.
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
        $anggota = $this->parseAnggotaDariExcel($record->data_pengaju2 ?? null);

        if ($tujuan === 'produk') {
            $id = DB::table('produks')->insertGetId([
                'kbk_id' => $kbkId,
                'nama_produk' => $mapping['judul'],
                'deskripsi' => $mapping['deskripsi'],
                'gambar' => null,
                'inventor' => $mapping['nama_pengaju'],
                'anggota_inventor_lainnya' => $anggota,
                'email_inventor' => $mapping['email'],
                'lampiran' => $mapping['lampiran'],
                'tanggal_submit' => $mapping['tanggal'],
                'status' => 'Belum Divalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } elseif ($tujuan === 'penelitian') {
            $id = DB::table('penelitians')->insertGetId([
                'kbk_id' => $kbkId,
                'judul' => $mapping['judul'],
                'abstrak' => $mapping['deskripsi'],
                'gambar' => null,
                'penulis' => $mapping['nama_pengaju'],
                'anggota_penulis_lainnya' => $anggota,
                'email_penulis' => $mapping['email'],
                'lampiran' => $mapping['lampiran'],
                'tanggal_publikasi' => $mapping['tanggal'],
                'status' => 'Belum Divalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
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
     * Baca file Excel 'data_pengaju2' (format: baris 1-5 header info,
     * baris 6 nama kolom "No., Nama, Email, No. Telpon, ...", baris 7+
     * data anggota), ambil kolom "Nama" saja, gabung jadi string
     * dipisah koma. Kembalikan null kalau file tidak ada / kosong /
     * gagal dibaca (tidak melempar exception supaya proses kirim tetap
     * lanjut walau file Excel bermasalah).
     */
    protected function parseAnggotaDariExcel(?string $relativePath): ?string
    {
        if (! $relativePath) {
            return null;
        }

        // File KI disimpan di disk 'public' atau 'private' tergantung jenisnya;
        // coba kedua kemungkinan lokasi fisik.
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
                return null;
            }

            $namaList = [];
            for ($i = $headerRowIndex + 1; $i < count($rows); $i++) {
                $nama = trim((string) ($rows[$i][1] ?? ''));
                if ($nama !== '') {
                    $namaList[] = $nama;
                }
            }

            return empty($namaList) ? null : implode(', ', $namaList);
        } catch (\Throwable $e) {
            // File korup / bukan xlsx valid / dsb -- jangan hentikan proses kirim
            return null;
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
                'lampiran' => $record->sertifikat_paten ?: $record->gambar_paten,
            ],
            'hak_cipta' => [
                'judul' => $record->judul_ciptaan,
                'deskripsi' => $record->uraian_singkat,
                'nama_pengaju' => $record->nama_lengkap,
                'email' => $record->email,
                'tanggal' => $record->tanggal_permohonan,
                'lampiran' => $record->sertifikat_hakcipta ?: $record->dokumen_invensi,
            ],
            'desain_industri' => [
                'judul' => $record->judul_di,
                'deskripsi' => $record->uraian_di,
                'nama_pengaju' => $record->nama_lengkap,
                'email' => $record->email,
                'tanggal' => $record->tanggal_permohonan,
                'lampiran' => $record->sertifikat_desain ?: $record->gambar_di,
            ],
            default => throw new \InvalidArgumentException("Jenis KI tidak dikenal: {$jenisKi}"),
        };
    }
}