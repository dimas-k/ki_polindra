<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DesainIndustri;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ApiDiController extends Controller
{
    /**
     * Ringkasan jumlah desain industri per status.
     */
    public function countAllDataDi(): JsonResponse
    {
        return response()->json([
            'total' => DesainIndustri::count(),
            'diberi' => DesainIndustri::where('status', 'Diberi')->count(),
            'diproses' => DesainIndustri::where('status', '!=', 'Diberi')
                ->where('status', '!=', 'Ditolak')
                ->count(),
            'ditolak' => DesainIndustri::where('status', 'Ditolak')->count(),
        ]);
    }

    /**
     * Daftar desain industri yang sudah "Diberi" (granted).
     * Field dibatasi ke data non-sensitif.
     *
     * Catatan: uraian_di dan gambar_di semuanya berupa file PDF
     * (bukan gambar biasa), jadi yang dikirim adalah URL dokumennya.
     */
    public function getDataDiberi(): JsonResponse
    {
        $data = DesainIndustri::with('prodi.jurusan')
            ->where('status', 'Diberi')
            ->orderByDesc('id')
            ->get()
            ->map(function ($di) {
                return [
                    'id' => $di->id,
                    'judul' => $di->judul_di,
                    'nama_pengaju' => $di->nama_lengkap,
                    'prodi' => $di->prodi->nama_prodi ?? $di->prodi ?? null,
                    'jurusan' => $di->prodi->jurusan->nama_jurusan ?? $di->jurusan ?? null,
                    'dokumen' => [
                        'uraian_di' => $di->uraian_di ? Storage::disk('public')->url($di->uraian_di) : null,
                        'gambar_di' => $di->gambar_di ? Storage::disk('public')->url($di->gambar_di) : null,
                    ],
                ];
            });

        return response()->json([
            'total' => $data->count(),
            'data' => $data,
        ]);
    }
}
