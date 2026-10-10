<?php

namespace App\Support;

use Illuminate\Http\Request;

/**
 * Helper untuk field upload yang boleh diisi LEBIH DARI SATU file
 * sekaligus (campuran PDF dan/atau gambar jpg/jpeg/png), contoh:
 * gambar_paten, gambar_tampilan, gambar_di.
 *
 * Disimpan sebagai JSON array of path di kolom (kolom harus TEXT,
 * lihat migration 2026_10_07_103200_change_gambar_columns_to_text_for_multi_upload).
 *
 * Tetap kompatibel dengan data lama yang masih berupa satu path
 * string biasa (bukan JSON) — decode() akan membungkusnya jadi array
 * berisi satu elemen.
 */
class MultiFileStorage
{
    public const RULE_REQUIRED = 'required|array|min:1';
    public const RULE_NULLABLE = 'nullable|array';
    public const RULE_EACH_FILE = 'file|mimes:pdf,jpg,jpeg,png|max:2028';

    /**
     * Simpan semua file yang diupload di field $field (bisa banyak,
     * butuh atribut `multiple` di <input>) ke $folder pada $disk, lalu
     * kembalikan JSON array berisi path-nya. Null kalau tidak ada file.
     */
    public static function store(Request $request, string $field, string $folder, string $disk = 'public'): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $files = $request->file($field);
        // request->file() mengembalikan satu UploadedFile kalau cuma 1 file
        // dipilih (bukan array), jadi dibungkus dulu biar konsisten.
        if (! is_array($files)) {
            $files = [$files];
        }

        $paths = [];
        foreach ($files as $file) {
            if (! $file) {
                continue;
            }
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $paths[] = $file->storeAs($folder, $filename, $disk);
        }

        return $paths ? json_encode($paths) : null;
    }

    /**
     * Baca nilai kolom (JSON array ATAU path string lama) jadi array
     * path yang konsisten untuk ditampilkan di view.
     */
    public static function decode(?string $value): array
    {
        if (! $value) {
            return [];
        }

        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        // Data lama: cuma satu path string biasa, bukan JSON.
        return [$value];
    }

    public const IMAGE_EXT = ['jpg', 'jpeg', 'png'];

    /** Path file pertama yang bertipe gambar (jpg/jpeg/png), atau null. Dipakai dashboard. */
    public static function firstImage(?string ...$values): ?string
    {
        foreach ($values as $value) {
            foreach (self::decode($value) as $path) {
                if (in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), self::IMAGE_EXT, true)) {
                    return $path;
                }
            }
        }
        return null;
    }

    /** Path file pertama yang BUKAN gambar (PDF dsb), fallback file pertama. */
    public static function firstDocument(?string $value): ?string
    {
        $all = self::decode($value);
        foreach ($all as $path) {
            if (strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'pdf') {
                return $path;
            }
        }
        return $all[0] ?? null;
    }

    public static function isImage(string $path): bool
    {
        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), self::IMAGE_EXT, true);
    }
}
