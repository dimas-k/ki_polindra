<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DesainIndustri;
use Illuminate\Http\JsonResponse;

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
                ];
            });

        return response()->json([
            'total' => $data->count(),
            'data' => $data,
        ]);
    }
}
