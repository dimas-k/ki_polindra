<?php

namespace App\Support;

use App\Models\Paten;
use Illuminate\Support\Facades\Storage;

class PatenPrivateFile
{
    private const FIELDS = [
        'ktp_inventor', 'data_pengaju2', 'pengalihan_hak', 'klaim',
        'pernyataan_kepemilikan', 'surat_kuasa', 'abstrak_paten',
        'deskripsi_paten', 'gambar_paten', 'gambar_tampilan', 'sertifikat_paten',
    ];

    public static function findRecord(string $filename): ?Paten
    {
        $relativePath = 'dokumen-paten/' . basename($filename);

        return Paten::where(function ($query) use ($relativePath) {
            foreach (self::FIELDS as $field) {
                $query->orWhere($field, $relativePath)
                    // JSON bisa menyimpan slash sebagai \/, jadi cari basename
                    // file tanpa mengasumsikan bentuk serialisasi path-nya.
                    ->orWhere($field, 'LIKE', '%' . basename($relativePath) . '%');
            }
        })->first();
    }

    public static function response(string $filename)
    {
        $relativePath = 'dokumen-paten/' . basename($filename);
        foreach (['private', 'public'] as $disk) {
            $storage = Storage::disk($disk);
            if ($storage->exists($relativePath)) {
                if ($disk === 'public') {
                    $privateStorage = Storage::disk('private');
                    $privateStorage->put($relativePath, $storage->get($relativePath));
                    $storage->delete($relativePath);
                    return response()->file($privateStorage->path($relativePath));
                }
                return response()->file($storage->path($relativePath));
            }
        }

        abort(404, 'File tidak ditemukan.');
    }
}
