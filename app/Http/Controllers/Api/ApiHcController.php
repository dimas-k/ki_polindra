<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HakCipta;
use Illuminate\Http\JsonResponse;

class ApiHcController extends Controller
{
    /**
     * Status final hak cipta di SIKI Polindra namanya "Tercatat"
     * (BEDA dengan Paten/Desain Industri yang statusnya "Diberi").
     */
    private const STATUS_FINAL = 'Tercatat';

    /**
     * Ringkasan jumlah hak cipta per status.
     */
    public function countAllDataHc(): JsonResponse
    {
        return response()->json([
            'total' => HakCipta::count(),
            'diberi' => HakCipta::where('status', self::STATUS_FINAL)->count(),
            'diproses' => HakCipta::where('status', '!=', self::STATUS_FINAL)
                ->where('status', '!=', 'Ditolak')
                ->count(),
            'ditolak' => HakCipta::where('status', 'Ditolak')->count(),
        ]);
    }

    /**
     * Daftar hak cipta yang statusnya sudah "Tercatat" (final).
     * Field dibatasi ke data non-sensitif.
     */
    public function getDataDiberi(): JsonResponse
    {
        $data = HakCipta::with('prodi.jurusan')
            ->where('status', self::STATUS_FINAL)
            ->orderByDesc('id')
            ->get()
            ->map(function ($hc) {
                return [
                    'id' => $hc->id,
                    'judul' => $hc->judul_ciptaan,
                    'jenis_ciptaan' => $hc->jenis_ciptaan,
                    'nama_pengaju' => $hc->nama_lengkap,
                    'prodi' => $hc->prodi->nama_prodi ?? $hc->prodi ?? null,
                    'jurusan' => $hc->prodi->jurusan->nama_jurusan ?? $hc->jurusan ?? null,
                ];
            });

        return response()->json([
            'total' => $data->count(),
            'data' => $data,
        ]);
    }
}
