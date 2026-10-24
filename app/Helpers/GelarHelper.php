<?php

namespace App\Helpers;

class GelarHelper
{
    /**
     * Daftar gelar/gelar kehormatan yang biasa ditulis di DEPAN nama
     * (contoh: "Dr. Ir. H. Budi Santoso").
     *
     * @var array<int, string>
     */
    protected static array $gelarDepan = [
        'Prof', 'Dr', 'dr', 'drg', 'Ir', 'Drs', 'Dra', 'H', 'Hj', 'KH',
    ];

    /**
     * Menghilangkan gelar akademik/kehormatan dari sebuah nama lengkap,
     * baik yang ditulis di depan (Dr., Ir., H., Hj., dst) maupun yang
     * ditulis di belakang dan dipisahkan koma (S.Kom., M.T., Ph.D., dst).
     *
     * Contoh:
     *  "Hj. Winani, S.Kep. Ners., M.Kep."       -> "Winani"
     *  "Bachtiar Efendi, S.Kep., Ns., M.H."     -> "Bachtiar Efendi"
     *  "Dr. Ir. H. Budi Santoso, S.T., M.T."    -> "Budi Santoso"
     *
     * Catatan: fungsi ini HANYA dipakai untuk inputan nama lengkap pada
     * form/pengajuan Kekayaan Intelektual (paten, hak cipta, desain
     * industri). Kolom "nama_lengkap" pada tabel users (data akun/profil)
     * TIDAK diubah dan tetap menyimpan gelar seperti biasa.
     */
    public static function stripGelar(?string $namaLengkap): string
    {
        $nama = trim((string) $namaLengkap);

        if ($nama === '') {
            return '';
        }

        // Gelar belakang biasanya ditulis setelah koma pertama,
        // contoh: "Budi Santoso, S.T., M.T." -> ambil "Budi Santoso" saja.
        $namaSajaString = trim(explode(',', $nama)[0]);

        // Pecah jadi kata per kata lalu buang token di awal yang cocok
        // dengan daftar gelar depan (dengan atau tanpa tanda titik).
        $kata = preg_split('/\s+/', $namaSajaString, -1, PREG_SPLIT_NO_EMPTY);

        while (count($kata) > 1) {
            $tokenPertama = rtrim($kata[0], '.');

            if (in_array($tokenPertama, self::$gelarDepan, true)) {
                array_shift($kata);
            } else {
                break;
            }
        }

        $hasil = implode(' ', $kata);

        return trim($hasil, " ,.\t\n\r\0\x0B");
    }
}
