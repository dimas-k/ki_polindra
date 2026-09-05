<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Jurusan;

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

        // Daftar jurusan diambil dari tabel master 'jurusan' supaya dropdown
        // di form Tambah/Update KBK tidak lagi berupa teks bebas (mencegah
        // typo & data jurusan yang tidak konsisten).
        $jurusanList = Jurusan::orderBy('nama_jurusan')->get();

        return view('produkinovasi::admin.kbk.index', compact('kbk', 'kbk_navigasi', 'jurusanList'));
    }

    public function storeKelompokKeahlian(Request $request)
    {
        $validasidata = $request->validate(
            [
                // 'unique' dicek supaya tidak ada nama KBK yang duplikat.
                'nama_kbk' => 'required|string|max:255|unique:kelompok_keahlians,nama_kbk',
                // Wajib salah satu nama jurusan yang ada di tabel master
                // 'jurusan' (dropdown), bukan lagi teks bebas.
                'jurusan' => 'required|string|max:255|exists:jurusan,nama_jurusan',
                // Sebelumnya field ini tidak divalidasi sama sekali.
                'deskripsi' => 'nullable|string',
            ],
            [
                'nama_kbk.required' => 'Nama KBK harus diisi',
                'nama_kbk.unique' => 'Nama KBK ini sudah terdaftar, gunakan nama lain',
                'jurusan.required' => 'Jurusan harus dipilih',
                'jurusan.exists' => 'Jurusan yang dipilih tidak valid',
            ]
        );

        $kbk = new KelompokKeahlian();
        $kbk->nama_kbk = $validasidata['nama_kbk'];
        $kbk->jurusan = $validasidata['jurusan'];
        // Bersihkan HTML dari CKEditor sebelum disimpan, supaya tidak ada
        // script/atribut berbahaya yang lolos ke halaman publik (stored XSS).
        $kbk->deskripsi = $this->sanitizeDeskripsi($validasidata['deskripsi'] ?? null);
        $kbk->save();

        return redirect('/admin/kelompok-bidang-keahlian')->with('success', 'Kelompok Keahlian berhasil ditambahkan');
    }

    public function hapusKbk(string $id)
    {
        try {
            // Coba untuk menghapus KBK
            $kbk = KelompokKeahlian::findOrFail($id);
            $kbk->delete();

            return response()->json(['message' => 'KBK berhasil dihapus.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data KBK tidak ditemukan.'], 404);
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
        // Catatan: method ini tidak dipakai oleh route manapun (dead code).
        // Bug lama: view('/admin/kelompok-bidang-keahlian/kbk', compact('admin'))
        // memakai variabel $admin yang tidak pernah didefinisikan. Diperbaiki
        // supaya konsisten kalau suatu saat dipakai kembali.
        $kbk = KelompokKeahlian::findOrFail($id);
        $jurusanList = Jurusan::orderBy('nama_jurusan')->get();
        return view('produkinovasi::admin.kbk.edit.index', compact('kbk', 'jurusanList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // findOrFail supaya tidak fatal error kalau ID tidak ditemukan
        // (sebelumnya pakai find() yang bisa mengembalikan null).
        $kbk = KelompokKeahlian::findOrFail($id);

        $validasidata = $request->validate(
            [
                // Abaikan record ini sendiri saat cek keunikan nama.
                'nama_kbk' => 'required|string|max:255|unique:kelompok_keahlians,nama_kbk,' . $kbk->id,
                'jurusan' => 'required|string|max:255|exists:jurusan,nama_jurusan',
                'deskripsi' => 'nullable|string',
            ],
            [
                'nama_kbk.required' => 'Nama KBK harus diisi',
                'nama_kbk.unique' => 'Nama KBK ini sudah terdaftar, gunakan nama lain',
                'jurusan.required' => 'Jurusan harus dipilih',
                'jurusan.exists' => 'Jurusan yang dipilih tidak valid',
            ]
        );

        $kbk->nama_kbk = $validasidata['nama_kbk'];
        $kbk->jurusan = $validasidata['jurusan'];
        $kbk->deskripsi = $this->sanitizeDeskripsi($validasidata['deskripsi'] ?? null);
        $kbk->save();

        return redirect('/admin/kelompok-bidang-keahlian')->with('success', 'Data KBK berhasil di update');
    }

    /**
     * Bersihkan HTML hasil CKEditor sebelum disimpan ke database.
     *
     * Tujuannya: mencegah stored XSS pada field 'deskripsi' yang
     * ditampilkan tanpa di-escape ({!! !!}) di halaman publik dashboard
     * produk inovasi. Hanya tag pemformatan teks dasar yang diizinkan,
     * dan atribut event handler (onclick, onerror, dst) serta skema
     * 'javascript:' pada href/src akan dibuang.
     */
    private function sanitizeDeskripsi(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return null;
        }

        $allowedTags = '<p><br><b><strong><i><em><u><ul><ol><li><h1><h2><h3><h4><h5><h6><span><a><blockquote>';
        $clean = strip_tags($html, $allowedTags);

        // Buang atribut event handler seperti onclick="", onerror="", dst.
        $clean = preg_replace('/\s+on\w+\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $clean);

        // Cegah href/src berisi skema javascript: (XSS lewat link/gambar).
        $clean = preg_replace('/(href|src)\s*=\s*(["\']?)\s*javascript:[^"\'>]*/i', '$1=$2#', $clean);

        return $clean;
    }
}