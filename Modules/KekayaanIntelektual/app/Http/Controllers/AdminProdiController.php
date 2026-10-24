<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class AdminProdiController extends Controller
{
    /**
     * Tampilkan daftar prodi beserta jurusannya.
     */
    public function index()
    {
        $prodi = Prodi::with('jurusan')->orderBy('nama_prodi', 'asc')->get();
        $jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();

        return view('kekayaanintelektual::admin.prodi-page.index', compact('prodi', 'jurusan'));
    }

    /**
     * Simpan data prodi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'nama_prodi' => 'required|string|max:100',
            'kode_prodi' => 'required|string|max:20|unique:prodi,kode_prodi',
        ]);

        Prodi::create($validated);

        return redirect('/admin/prodi')->with('success', 'Data prodi berhasil ditambahkan');
    }

    /**
     * Perbarui data prodi.
     */
    public function update(Request $request, string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $validated = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'nama_prodi' => 'required|string|max:100',
            'kode_prodi' => 'required|string|max:20|unique:prodi,kode_prodi,' . $prodi->id,
        ]);

        $prodi->update($validated);

        return redirect('/admin/prodi')->with('success', 'Data prodi berhasil diubah');
    }

    /**
     * Hapus data prodi.
     */
    public function destroy(string $id)
    {
        Prodi::findOrFail($id)->delete();

        return redirect('/admin/prodi')->with('success', 'Data prodi berhasil dihapus');
    }
}
