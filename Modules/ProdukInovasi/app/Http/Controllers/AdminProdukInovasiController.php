<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use Modules\ProdukInovasi\app\Models\Produk;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Modules\ProdukInovasi\app\Models\ProdukAnggota;
use App\Models\User;
use App\Models\KbkPenugasan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminProdukInovasiController extends Controller
{
    public function pageProduk($id)
    {
        $kbk_navigasi1 = KelompokKeahlian::select('id', 'nama_kbk')->where('id', $id)->first();
        $data_produk = Produk::with('kelompokKeahlian') ->where('kbk_id', $id) ->paginate(10); 


        return view('produkinovasi::admin.produk.index', compact('kbk_navigasi1', 'data_produk'));
    }

    public function ShowPageProduk($id)
    {
        $produk = Produk::with('KelompokKeahlian')->findOrFail($id);
        return view('produkinovasi::admin.produk.show.index', compact('produk'));
    }

    public function validateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->status = $request->has('status') ? 'Tervalidasi' : 'Belum Divalidasi';
        $produk->save();

        return redirect()->route('admin.produk', ['id' => $produk->kbk_id])->with('success', 'Produk tervalidasi');
    }

    /**
     * Form edit Produk Inovasi untuk Admin. Admin boleh mengedit produk
     * milik KBK mana pun (tidak dibatasi seperti Ketua KBK yang hanya
     * boleh mengedit produk KBK-nya sendiri).
     */
    public function editProduk($id)
    {
        $produk = Produk::with(['kelompokKeahlian', 'anggota.detail'])->findOrFail($id);

        // Daftar kandidat "anggota inventor" terstruktur: Ketua KBK (users)
        // dan Anggota KBK (anggota_kelompok_keahlians), sama seperti yang
        // dipakai Ketua KBK di form tambah/edit produknya sendiri.
        $inventorK = DB::table('users')
            ->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'users.id',
                'users.nama_lengkap',
                'kelompok_keahlians.nama_kbk as nama_kbk'
            )
            ->whereIn('users.id', KbkPenugasan::ketuaAktifUserIds())
            ->get();

        $inventorA = DB::table('anggota_kelompok_keahlians')
            ->join('kelompok_keahlians', 'anggota_kelompok_keahlians.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'anggota_kelompok_keahlians.id as id',
                'anggota_kelompok_keahlians.nama_lengkap as nama_lengkap',
                'anggota_kelompok_keahlians.jabatan as jabatan',
                'kelompok_keahlians.nama_kbk as nama_kbk'
            )
            ->get();

        return view('produkinovasi::admin.produk.edit.index', compact('produk', 'inventorK', 'inventorA'));
    }

    /**
     * Proses update Produk Inovasi oleh Admin. Mengikuti pola yang sama
     * dengan KetuaKbkController@updateProdukInovasi (ganti gambar/lampiran
     * kalau diupload, dan ganti daftar anggota inventor kalau dikirim),
     * tapi tanpa pembatasan kbk_id milik sendiri karena ini area Admin.
     */
    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'inventor' => 'nullable|string|max:255',
            'inventor_lainnya' => 'nullable|string|max:255',
            'anggota_inventor' => 'nullable|array',
            'anggota_inventor.*' => 'string',
            'anggota_inventor_lainnya' => 'nullable|string|max:255',
            'email_inventor' => 'required|email',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
            'tanggal_submit' => 'nullable|date',
            'tanggal_granted' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();

            $produk = Produk::findOrFail($id);

            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi = $request->deskripsi;
            $produk->inventor = $request->inventor;
            $produk->inventor_lainnya = $request->inventor_lainnya;
            $produk->anggota_inventor_lainnya = $request->anggota_inventor_lainnya;
            $produk->email_inventor = $request->email_inventor;
            $produk->tanggal_submit = $request->tanggal_submit;
            $produk->tanggal_granted = $request->tanggal_granted;

            // Proses upload gambar baru (kalau ada)
            if ($request->hasFile('gambar')) {
                if ($produk->gambar && Storage::exists($produk->gambar)) {
                    Storage::delete($produk->gambar);
                }

                $originalName = $request->file('gambar')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $produk->gambar = $request->file('gambar')->storeAs('dokumen-produk', $fileName);
            }

            // Proses upload lampiran baru (kalau ada)
            if ($request->hasFile('lampiran')) {
                if ($produk->lampiran && Storage::exists($produk->lampiran)) {
                    Storage::delete($produk->lampiran);
                }

                $originalName = $request->file('lampiran')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $produk->lampiran = $request->file('lampiran')->storeAs('dokumen-produk', $fileName);
            }

            $produk->save();

            // Update anggota inventor terstruktur kalau admin mengirim pilihan baru
            if ($request->filled('anggota_inventor')) {
                ProdukAnggota::where('produk_id', $produk->id)->delete();

                foreach ($request->anggota_inventor as $anggota) {
                    if (str_starts_with($anggota, 'user_')) {
                        $anggotaId = str_replace('user_', '', $anggota);
                        $table = 'users';
                    } elseif (str_starts_with($anggota, 'anggota_')) {
                        $anggotaId = str_replace('anggota_', '', $anggota);
                        $table = 'anggota_kelompok_keahlians';
                    } else {
                        continue; // Skip jika format tidak sesuai
                    }

                    ProdukAnggota::create([
                        'produk_id' => $produk->id,
                        'anggota_id' => $anggotaId,
                        'anggota_type' => $table,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('show.produk', $produk->id)->with('success', 'Data Produk berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
