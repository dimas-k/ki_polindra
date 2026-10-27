<?php

namespace App\Support;

use App\Models\DesainIndustri;
use App\Models\HakCipta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class KiPrivateFile
{
    private const FIELDS = [
        'hc' => [
            'ktp_inventor', 'data_pengaju2', 'dokumen_invensi', 'gambar_ciptaan',
            'surat_pengalihan', 'surat_pernyataan', 'sertifikat_hakcipta',
        ],
        'di' => [
            'ktp_inventor', 'data_pengaju2', 'uraian_di', 'gambar_di',
            'surat_kepemilikan', 'surat_pengalihan', 'sertifikat_desain',
        ],
    ];

    /** Return all records linked to the file; checking all avoids false denials on filename collisions. */
    public static function matchingRecords(string $type, string $filename): Collection
    {
        $model = self::model($type);
        $folder = self::folder($type);
        $filename = basename($filename);
        $path = $folder . '/' . $filename;

        $records = $model::where(function ($query) use ($type, $path, $filename) {
            foreach (self::FIELDS[$type] as $field) {
                $query->orWhere($field, $path)
                    // JSON encoding may escape slashes, so match the filename itself.
                    ->orWhere($field, 'LIKE', '%' . $filename . '%');
            }
        })->get();

        return $records->filter(function (Model $record) use ($type, $filename) {
            foreach (self::FIELDS[$type] as $field) {
                foreach (MultiFileStorage::decode($record->{$field}) as $storedPath) {
                    if (basename((string) $storedPath) === $filename) {
                        return true;
                    }
                }
            }

            return false;
        })->values();
    }

    public static function responseForOwner(string $type, string $filename, int $userId)
    {
        $ownsFile = self::matchingRecords($type, $filename)
            ->contains(fn (Model $record) => (int) $record->user_id === $userId);

        if (! $ownsFile) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        return self::fileResponse($type, $filename);
    }

    public static function responseForStaff(string $type, string $filename)
    {
        if (self::matchingRecords($type, $filename)->isEmpty()) {
            abort(404, 'File tidak ditemukan.');
        }

        return self::fileResponse($type, $filename);
    }

    private static function fileResponse(string $type, string $filename)
    {
        $relativePath = self::folder($type) . '/' . basename($filename);
        $private = Storage::disk('private');

        if ($private->exists($relativePath)) {
            return response()->file($private->path($relativePath));
        }

        $public = Storage::disk('public');
        if ($public->exists($relativePath)) {
            // Migrate an older public file only after the route has authorized access.
            $private->put($relativePath, $public->get($relativePath));
            $public->delete($relativePath);
            return response()->file($private->path($relativePath));
        }

        abort(404, 'File tidak ditemukan.');
    }

    private static function model(string $type): string
    {
        return match ($type) {
            'hc' => HakCipta::class,
            'di' => DesainIndustri::class,
            default => throw new \InvalidArgumentException('Jenis dokumen KI tidak valid.'),
        };
    }

    private static function folder(string $type): string
    {
        return match ($type) {
            'hc' => 'dokumen-hc',
            'di' => 'dokumen-di',
            default => throw new \InvalidArgumentException('Jenis dokumen KI tidak valid.'),
        };
    }
}
