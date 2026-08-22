<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paten;
use Illuminate\Http\JsonResponse;

class ApiPatenController extends Controller
{
    /**
     * Ringkasan jumlah paten per status.
     * Dipakai sistem lain (misal Dashboard Produk Inovasi) untuk
     * menampilkan statistik tanpa perlu akses langsung ke database SIKI.
     */
    public function countAllDataPaten(): JsonResponse
    {
        return response()->json([
            'total' => Paten::count(),
            'diberi' => Paten::where('status', 'Diberi')->count(),
            'diproses' => Paten::where('status', '!=', 'Diberi')
                ->where('status', '!=', 'Ditolak')
                ->count(),
            'ditolak' => Paten::where('status', 'Ditolak')->count(),
        ]);
    }

    /**
     * Daftar paten yang sudah "Diberi" (granted).
     * Field yang dikirim sengaja dibatasi ke data non-sensitif saja
     * (tanpa KTP, alamat, kontak pribadi pengaju).
     */
    public function getDataDiberi(): JsonResponse
    {
        $data = Paten::with('prodi.jurusan')
            ->where('status', 'Diberi')
            ->orderByDesc('tanggal_permohonan')
            ->get()
            ->map(function ($paten) {
                return [
                    'id' => $paten->id,
                    'judul' => $paten->judul_paten,
                    'jenis_paten' => $paten->jenis_paten,
                    'nama_pengaju' => $paten->nama_lengkap,
                    'prodi' => $paten->prodi->nama_prodi ?? $paten->prodi ?? null,
                    'jurusan' => $paten->prodi->jurusan->nama_jurusan ?? $paten->jurusan ?? null,
                    'tanggal_permohonan' => $paten->tanggal_permohonan,
                ];
            });

        return response()->json([
            'total' => $data->count(),
            'data' => $data,
        ]);
    }
}
