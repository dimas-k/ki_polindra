<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    /**
     * Tampilkan daftar jurusan.
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();

        return view('admin.jurusan-page.index', compact('jurusan'));
    }

    /**
     * Simpan data jurusan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'kode_jurusan' => 'required|string|max:20|unique:jurusan,kode_jurusan',
        ]);

        Jurusan::create($validated);

        return redirect('/admin/jurusan')->with('success', 'Data jurusan berhasil ditambahkan');
    }

    /**
     * Perbarui data jurusan.
     */
    public function update(Request $request, string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'kode_jurusan' => 'required|string|max:20|unique:jurusan,kode_jurusan,' . $jurusan->id,
        ]);

        $jurusan->update($validated);

        return redirect('/admin/jurusan')->with('success', 'Data jurusan berhasil diubah');
    }

    /**
     * Hapus data jurusan.
     * Ditolak kalau jurusan masih punya prodi terdaftar,
     * supaya data prodi tidak jadi yatim (jurusan_id null tanpa sengaja).
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        if ($jurusan->prodi()->exists()) {
            return redirect('/admin/jurusan')
                ->with('error', 'Jurusan tidak bisa dihapus karena masih memiliki data prodi. Hapus atau pindahkan prodi tersebut terlebih dahulu.');
        }

        $jurusan->delete();

        return redirect('/admin/jurusan')->with('success', 'Data jurusan berhasil dihapus');
    }
}
