<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class KelompokBidangController extends Controller
{
    public function pageKelompokBidang()
    {
        $kbk = KelompokKeahlian::all();

        $kbk_navigasi = DB::table('kelompok_keahlians')
            ->select(
                'kelompok_keahlians.id',
                'kelompok_keahlians.nama_kbk'
            )
            ->get();
        return view('produkinovasi::admin.kbk.index', compact('kbk', 'kbk_navigasi'));
    }

    public function storeKelompokKeahlian(Request $request)
    {
        $validasidata = $request->validate([
            'nama_kbk' => 'required|string|max:255',
            'jurusan' => 'string|max:255',
        ]);

        $kbk = new KelompokKeahlian();
        $kbk->nama_kbk = $request->nama_kbk;
        $kbk->jurusan = $request->jurusan;
        $kbk->deskripsi = $request->deskripsi;
        $kbk->save($validasidata);

        return redirect('/admin/kelompok-bidang-keahlian')->with('success', 'Kelompok Keahlian berhasil ditambahkan');
    }
    public function hapusKbk(string $id)
    {
        try {
            // Coba untuk menghapus KBK
            $kbk = KelompokKeahlian::findOrFail($id);
            $kbk->delete();

            return response()->json(['message' => 'KBK berhasil dihapus.'], 200);
        } catch (QueryException $e) {
            // Jika error integrity constraint terjadi, tampilkan pesan sederhana
            if ($e->getCode() == 23000) {
                return response()->json([
                    'message' => 'KBK tidak bisa dihapus karena masih terhubung di data atau halaman lain. Silakan hapus data yang terkait terlebih dahulu.'
                ], 400);
            }
            // Tampilkan error lain
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus KBK.'], 500);
        }
    }

    public function edit(string $id)
    {
        $kbk = KelompokKeahlian::find($id);
        return view('/admin/kelompok-bidang-keahlian/kbk', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kbk = KelompokKeahlian::find($id);
        $kbk->nama_kbk = $request->nama_kbk;
        $kbk->jurusan = $request->jurusan;
        $kbk->deskripsi = $request->deskripsi;
        $kbk->save();
        return redirect('/admin/kelompok-bidang-keahlian')->with('success', 'Data admin berhasil di update');
    }
}
