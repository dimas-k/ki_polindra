<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use App\Models\User;
use Modules\ProdukInovasi\app\Models\Produk;
use Modules\ProdukInovasi\app\Models\Penelitian;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\ProdukAnggota;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Modules\ProdukInovasi\app\Models\PenelitianAnggota;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Modules\ProdukInovasi\app\Models\AnggotaKelompokKeahlian;
use Illuminate\Support\Facades\Storage;


class KetuaKbkController extends Controller
{
    public function dashboardPage()
    {
        // Data Produk per Tahun
        $kelompokKeahlianId = Auth::user()->kelompokKeahlian->id ?? null;
        $prdk_tahun = Produk::with('kelompokKeahlian')->whereNotNull('tanggal_granted')
            ->where('status', 'Tervalidasi')->where('kbk_id', $kelompokKeahlianId)
            ->get()
            ->groupBy(function ($item) {
                return $item->tanggal_granted->format('Y');
            })
            ->map(function ($group) {
                return $group->count();
            })->sortKeys();

        // Data Penelitian per Tahun
        $plt_tahun = Penelitian::with('kelompokKeahlian')->whereNotNull('tanggal_publikasi')
            ->where('status', 'Tervalidasi')->where('kbk_id', $kelompokKeahlianId)
            ->get()
            ->groupBy(function ($item) {
                return $item->tanggal_publikasi->format('Y');
            })
            ->map(function ($group) {
                return $group->count();
            })->sortKeys();
        // Distribusi Status Produk
        $prdk_valid = Produk::with('kelompokKeahlian')->where('kbk_id', $kelompokKeahlianId)->where('status', 'Tervalidasi')->count();
        $prdk_nonvalid = Produk::with('kelompokKeahlian')->where('kbk_id', $kelompokKeahlianId)->where('status', 'Belum Divalidasi')->count();

        $pnltan_valid = Penelitian::with('kelompokKeahlian')->where('kbk_id', $kelompokKeahlianId)->where('status', 'Tervalidasi')->count();
        $pnltan_nonvalid = Penelitian::with('kelompokKeahlian')->where('kbk_id', $kelompokKeahlianId)->where('status', 'Belum Divalidasi')->count();
        return view('produkinovasi::k_kbk.index', compact('pnltan_valid', 'pnltan_nonvalid', 'pnltan_nonvalid', 'prdk_valid', 'prdk_nonvalid', 'prdk_tahun', 'plt_tahun'));
    }

    public function anggotaPage()
    {
        $kelompokKeahlianId = Auth::user()->kelompokKeahlian->id ?? null;
        $anggotas = AnggotaKelompokKeahlian::with('kelompokKeahlian')
            ->where('kbk_id', $kelompokKeahlianId) // Ganti dengan ID KBK yang sesuai
            ->paginate(10);

        $userId = Auth::id();
        $kkbk = DB::table('users')->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'kelompok_keahlians.id',
                'kelompok_keahlians.nama_kbk',
                'users.nama_lengkap'
            )->where('users.id', '=', $userId)->first();

        return view('produkinovasi::k_kbk.anggota.index', compact('anggotas', 'kkbk'));
    }

    public function storeAnggota(Request $request)
    {
        try {
            $request->validate(
                [
                    'nama_lengkap' => 'required|string|max:255',
                    'jabatan' => 'required|string|max:255',
                    'kbk_id' => 'required|exists:kelompok_keahlians,id',
                    'email' => 'required|email',
                ],
                [
                    'nama_lengkap.required' => 'Nama Lengkap anggota harus diisi',
                    'jabatan.required' => 'Jabatan anggota harus diisi',
                    'kbk_id.required' => 'KBK harus diisi',
                    'email.required' => 'Email harus diisi',
                    'email.email' => 'Masukkan email yang valid'
                ]
            );

            // Cek apakah nama dan email sudah ada dalam KBK yang sama
            $exist_nama = AnggotaKelompokKeahlian::where('kbk_id', $request->input('kbk_id'))
                ->where('nama_lengkap', $request->input('nama_lengkap'))
                ->exists();
            $exist_email = AnggotaKelompokKeahlian::where('kbk_id', $request->input('kbk_id'))
                ->where('email', $request->input('email'))
                ->exists();

            if ($exist_nama) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nama sudah digunakan dalam KBK ini.'
                ], 422);
            }
            if ($exist_email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan dalam KBK ini.'
                ], 422);
            }

            // Jika tidak ada, simpan data anggota baru
            $anggota = new AnggotaKelompokKeahlian();
            $anggota->kbk_id = $request->input('kbk_id');
            $anggota->nama_lengkap = $request->input('nama_lengkap');
            $anggota->jabatan = $request->input('jabatan');
            $anggota->email = $request->input('email');
            $anggota->save();

            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateAnggota(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'nama_lengkap' => 'required|string|max:255',
                    'jabatan' => 'required|string|max:255',
                    'email' => 'required|email',
                ],
                [
                    'nama_lengkap.required' => 'Nama Lengkap anggota harus diisi',
                    'jabatan.required' => 'Jabatan anggota harus diisi',
                    'email.required' => 'Email harus diisi',
                    'email.email' => 'Masukkan email yang valid'
                ]
            );

            $anggota = AnggotaKelompokKeahlian::findOrFail($id);
            $anggota->nama_lengkap = $request->input('nama_lengkap');
            $anggota->jabatan = $request->input('jabatan');
            $anggota->email = $request->input('email');
            $anggota->save();
            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil diupdate.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $e->getMessage()
            ], 500);
        }
    }

    public function hapusAnggota($id)
    {
        $anggota = AnggotaKelompokKeahlian::findOrFail($id);
        $anggota->delete();

        return redirect('/k-kbk/anggota-kbk')->with('success', 'Data anggota berhasil dihapus!');
    }

    public function produkInovasi()
    {
        // $jenis_kbk = KelompokKeahlian::all();
        $kelompokKeahlianId = Auth::user()->kelompokKeahlian->id ?? null;

        // Query produk berdasarkan kelompok keahlian ID
        $produks = Produk::with('kelompokKeahlian')->where('kbk_id', $kelompokKeahlianId)->paginate(10);

        $userId = Auth::id();
        $kkbk = DB::table('users')
            ->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'kelompok_keahlians.id',
                'kelompok_keahlians.nama_kbk',
                'users.nama_lengkap'
            )
            ->where('users.id', '=', $userId)
            ->first();

        // dd($kkbk->nama_kbk);
        $user = auth()->user();
        $anggotaKelompok = AnggotaKelompokKeahlian::all();
        $produkAnggota = AnggotaKelompokKeahlian::all();

        $inventorK = DB::table('users')
            ->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'users.id',
                'users.nama_lengkap',
                'kelompok_keahlians.nama_kbk as nama_kbk'
            )
            ->where('users.role', '=', 'ketua_kbk')
            ->get();


        $inventorA = DB::table('anggota_kelompok_keahlians')
            ->join('users', 'anggota_kelompok_keahlians.kbk_id', '=', 'users.kbk_id')
            ->join('kelompok_keahlians', 'anggota_kelompok_keahlians.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'anggota_kelompok_keahlians.id as id',
                'anggota_kelompok_keahlians.nama_lengkap as nama_lengkap',
                'anggota_kelompok_keahlians.jabatan as jabatan',
                'kelompok_keahlians.nama_kbk as nama_kbk'
            )
            ->get();

        $inventors = $inventorK->merge($inventorA);


        return view('produkinovasi::k_kbk.produk.index', compact('produks', 'kkbk', 'anggotaKelompok', 'produkAnggota', 'inventors', 'inventorA', 'inventorK'));
    }


    public function showProduk($id)
    {
        try {
            $produk = Produk::with([
                'kelompokKeahlian',
                'anggota.detail' => function ($query) {
                    // Tambahkan pengecekan atau kustomisasi jika diperlukan
                }
            ])->findOrFail($id);
            // dd($produk);


            return view('produkinovasi::k_kbk.produk.show.index', compact('produk'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function storeProduk(Request $request)
    {
        // dd($request);
        try {
            // Validasi input
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'kbk_id' => 'required|exists:kelompok_keahlians,id',
                'inventor' => 'nullable|string|max:255',
                'inventor_lainnya' => 'nullable|string|max:255',
                'anggota_inventor' => 'array',
                'anggota_inventor.*' => 'string',
                'anggota_inventor_lainnya' => 'string|nullable|max:255',
                'email_inventor' => 'required|email',
                'gambar' => 'required|file|mimes:jpeg,png,jpg|max:10240',
                'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
                'tanggal_submit' => 'date',
                'tanggal_granted' => 'date'
            ]);
            DB::beginTransaction();
            $produk = new Produk();
            $produk->kbk_id = $request->kbk_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi = $request->deskripsi;
            $produk->inventor = $request->inventor;
            $produk->inventor_lainnya = $request->inventor_lainnya;
            $produk->anggota_inventor_lainnya = $request->anggota_inventor_lainnya;
            $produk->email_inventor = $request->email_inventor;
            $produk->tanggal_submit = $request->tanggal_submit;
            $produk->tanggal_granted = $request->tanggal_granted;

            // Proses upload gambar
            if ($request->hasFile('gambar')) {
                $originalName = $request->file('gambar')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $path = $request->file('gambar')->storeAs('dokumen-produk', $fileName);
                $produk->gambar = $path;
            }
            // Proses upload lampiran
            if ($request->hasFile('lampiran')) {
                $originalName = $request->file('lampiran')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $path = $request->file('lampiran')->storeAs('dokumen-produk', $fileName);
                $produk->lampiran = $path;
            }
            // Simpan produk ke database
            $produk->save();

            // Proses anggota inventor
            if (!empty($request->anggota_inventor) && is_array($request->anggota_inventor)) {
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
            // Return response success dalam format JSON
            return response()->json(['success' => true, 'message' => 'Data Produk berhasil ditambahkan!']);
        } catch (\Exception $e) {
            // Jika ada error, return response error dengan pesan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProdukInovasi(Request $request, $id)
    {
        // Validasi input
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

            // Ambil data produk berdasarkan ID
            $produk = Produk::findOrFail($id);

            // Update data produk
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi = $request->deskripsi;
            $produk->inventor = $request->inventor;
            $produk->inventor_lainnya = $request->inventor_lainnya;
            $produk->anggota_inventor_lainnya = $request->anggota_inventor_lainnya;
            $produk->email_inventor = $request->email_inventor;
            $produk->tanggal_submit = $request->tanggal_submit;
            $produk->tanggal_granted = $request->tanggal_granted;

            // Proses upload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus file lama jika ada
                if ($produk->gambar && Storage::exists($produk->gambar)) {
                    Storage::delete($produk->gambar);
                }

                // Upload file baru
                $originalName = $request->file('gambar')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $path = $request->file('gambar')->storeAs('dokumen-produk', $fileName);
                $produk->gambar = $path;
            }

            // Proses upload lampiran baru
            if ($request->hasFile('lampiran')) {
                // Hapus file lama jika ada
                if ($produk->lampiran && Storage::exists($produk->lampiran)) {
                    Storage::delete($produk->lampiran);
                }

                // Upload file baru
                $originalName = $request->file('lampiran')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $path = $request->file('lampiran')->storeAs('dokumen-produk', $fileName);
                $produk->lampiran = $path;
            }

            $produk->save();

            // Update anggota inventor
            if ($request->filled('anggota_inventor')) {
                // Hapus semua data lama di pivot table
                ProdukAnggota::where('produk_id', $produk->id)->delete();

                // Simpan data anggota inventor baru
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

            return redirect('/k-kbk/produk')->with('success', 'Data Produk berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function hapusProduk($id)
    {
        $produk = Produk::findOrFail($id);
        // Hapus gambar jika ada
        if ($produk->gambar && Storage::exists($produk->gambar)) {
            Storage::delete($produk->gambar);
        }
        // Hapus lampiran jika ada
        if ($produk->lampiran && Storage::exists($produk->lampiran)) {
            Storage::delete($produk->lampiran);
        }
        $produk->delete();
        return redirect('/k-kbk/produk')->with('success', 'Data Produk berhasil dihapus!');
    }

    // penelitian method
    public function penelitian()
    {
        $kelompokKeahlianId = Auth::user()->kelompokKeahlian->id ?? null;
        $penelitians = Penelitian::with('kelompokKeahlian')->where('kbk_id', $kelompokKeahlianId)->paginate(10);

        $userId = Auth::id();
        $kkbk = DB::table('users')
            ->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'kelompok_keahlians.id',
                'kelompok_keahlians.nama_kbk',
                'users.nama_lengkap'
            )
            ->where('users.id', '=', $userId)
            ->first();

        $user = auth()->user();
        $anggotaKelompok = AnggotaKelompokKeahlian::where('kbk_id', $user->kbk_id)->get();
        $penelitianAnggota = AnggotaKelompokKeahlian::all();
        $penelitian = Penelitian::with(['kelompokKeahlian', 'anggotaPenelitian.detailAnggota'])->find($userId);
        $penulisU = DB::table('users')
            ->select('id', 'nama_lengkap', 'jabatan')
            ->where('role', '=', 'ketua_kbk')
            ->get();

        $penulisK = DB::table('anggota_kelompok_keahlians')
            ->join('users', 'anggota_kelompok_keahlians.kbk_id', '=', 'users.kbk_id')
            ->join('kelompok_keahlians', 'anggota_kelompok_keahlians.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'anggota_kelompok_keahlians.id as id',
                'anggota_kelompok_keahlians.nama_lengkap as nama_lengkap',
                'anggota_kelompok_keahlians.jabatan as jabatan',
                'kelompok_keahlians.nama_kbk as nama_kbk'
            )
            ->get();
        // dd($penelitians);

        return view('produkinovasi::k_kbk.penelitian.index', compact('penelitians', 'kkbk', 'anggotaKelompok', 'penelitianAnggota', 'penelitian', 'penulisU', 'penulisK'));
    }


    public function showPenelitian($id)
    {
        $penelitian = Penelitian::with(['kelompokKeahlian', 'anggotaPenelitian.detailAnggota'])->findOrFail($id);
        // dd($penelitian->anggotaPenelitian);

        return view('produkinovasi::k_kbk.penelitian.show.index', compact('penelitian'));
    }


    public function storePenelitian(Request $request)
    {
        try {

            // Validasi input
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'abstrak' => 'required|string|max:5000',
                'kbk_id' => 'required|integer|exists:kelompok_keahlians,id',
                'penulis' => 'nullable|string|max:255',
                'penulis_lainnya' => 'nullable|string|max:255',
                'email_penulis' => 'required|email|max:255',
                'penulis_korespondensi_select' => 'nullable|string|max:255|required_without:penulis_korespondensi_lainnya',
                'penulis_korespondensi_lainnya' => 'nullable|string|max:255|required_without:penulis_korespondensi_select',
                'gambar' => 'required|file|mimes:jpeg,png,jpg|max:10240',
                'lampiran' => 'required|file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
                'tanggal_publikasi' => 'nullable|date',
                'anggota_penulis' => 'array',
                'anggota_penulis.*' => 'string',
                'anggota_penulis_lainnya' => 'nullable|string|max:255',

            ]);
            $penulisKorespondensi = $request->penulis_korespondensi_select
                ? $request->penulis_korespondensi_select
                : $request->penulis_korespondensi_lainnya;

            $penulisKorespondensi = $request->penulis_korespondensi_select
                ? $request->penulis_korespondensi_select
                : $request->penulis_korespondensi_lainnya;


            // Mulai transaksi
            DB::beginTransaction();

            // Simpan data penelitian
            $penelitian = new Penelitian();
            $penelitian->kbk_id = $request->kbk_id;
            $penelitian->judul = $request->judul;
            $penelitian->abstrak = $request->abstrak;
            $penelitian->penulis = $request->penulis;
            $penelitian->penulis_lainnya = $request->penulis_lainnya;
            $penelitian->email_penulis = $request->email_penulis;
            $penelitian->penulis_korespondensi = $penulisKorespondensi;
            $penelitian->anggota_penulis_lainnya = $request->anggota_penulis_lainnya;
            $penelitian->tanggal_publikasi = $request->tanggal_publikasi;
            // $penelitian->fill($validatedData);

            // Simpan gambar
            if ($request->hasFile('gambar')) {
                $fileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
                $penelitian->gambar = $request->file('gambar')->storeAs('dokumen-penelitian', $fileName);
            }

            // Simpan lampiran
            if ($request->hasFile('lampiran')) {
                $fileName = time() . '_' . $request->file('lampiran')->getClientOriginalName();
                $penelitian->lampiran = $request->file('lampiran')->storeAs('dokumen-penelitian', $fileName);
            }

            $penelitian->save($validatedData);

            if (!empty($request->anggota_penulis) && is_array($request->anggota_penulis)) {
                foreach ($request->anggota_penulis as $anggota) {
                    if (str_starts_with($anggota, 'user_')) {
                        $anggotaId = str_replace('user_', '', $anggota);
                        $table = 'users';
                    } elseif (str_starts_with($anggota, 'anggota_')) {
                        $anggotaId = str_replace('anggota_', '', $anggota);
                        $table = 'anggota_kelompok_keahlians';
                    } else {
                        continue; // Skip jika format tidak sesuai
                    }

                    PenelitianAnggota::create([
                        'penelitian_id' => $penelitian->id,
                        'anggota_id' => $anggotaId,
                        'anggota_type' => $table,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Penelitian berhasil disimpan.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // public function updatePenelitian(Request $request, $id)
    // {
    //     try {
    //         $request->validate([
    //             'judul' => 'required|string|max:255',
    //             'abstrak' => 'required|string',
    //             'penulis' => 'nullable|string|max:255',
    //             'penulis_lainnya' => 'nullable|string|max:255',
    //             'penulis_korespondensi' => 'nullable|string|max:255',
    //             'email_penulis' => 'required|email',
    //             'gambar' => 'file|mimes:jpeg,png,jpg|max:10240',
    //             'lampiran' => 'file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
    //             'tanggal_publikasi' => 'date'
    //         ], [
    //             'judul.required' => 'Judul penelitian wajib diisi.',
    //             // 'penulis.required' => 'Nama penulis wajib diisi.',
    //             'email_penulis.required' => 'Email penulis wajib diisi.',
    //             'email_penulis.email' => 'Email penulis tidak valid.',
    //             'abstrak.required' => 'Abstrak penelitian wajib diisi.',
    //             'gambar.max' => 'Ukuran file gambar maksimal 10MB.',
    //             'lampiran.max' => 'Ukuran file lampiran maksimal 10MB.',
    //             'gambar.mimes' => 'File gambar harus berupa JPG, JPEG, atau PNG.',
    //             'lampiran.mimes' => 'File lampiran harus berupa JPG, JPEG, PNG, PDF, atau DOCX.',
    //             'tanggal_publikasi.date' => 'Tanggal Publikasi Harus Valid'
    //         ]);
    //         $penelitian = Penelitian::findOrFail($id);
    //         $penelitian->judul = $request->judul;
    //         $penelitian->abstrak = $request->abstrak;
    //         $penelitian->penulis = $request->penulis;
    //         $penelitian->penulis_lainnya = $request->penulis_lainnya;
    //         $penelitian->email_penulis = $request->email_penulis;
    //         $penelitian->tanggal_publikasi = $request->tanggal_publikasi;

    //         // Proses upload gambar baru
    //         if ($request->hasFile('gambar')) {
    //             // Hapus file lama jika ada
    //             if ($penelitian->gambar && Storage::exists($penelitian->gambar)) {
    //                 Storage::delete($penelitian->gambar);
    //             }

    //             // Upload file baru
    //             $originalName = $request->file('gambar')->getClientOriginalName();
    //             $fileName = time() . '_' . str_replace(' ', '_', $originalName);
    //             $path = $request->file('gambar')->storeAs('dokumen-penelitian', $fileName);
    //             $penelitian->gambar = $path;
    //        }

    //         // Proses upload lampiran baru
    //         if ($request->hasFile('lampiran')) {
    //             // Hapus file lama jika ada
    //             if ($penelitian->lampiran && Storage::exists($penelitian->lampiran)) {
    //                 Storage::delete($penelitian->lampiran);
    //             }

    //             // Upload file baru
    //             $originalName = $request->file('lampiran')->getClientOriginalName();
    //             $fileName = time() . '_' . str_replace(' ', '_', $originalName);
    //             $path = $request->file('lampiran')->storeAs('dokumen-penelitian', $fileName);
    //             $penelitian->lampiran = $path;
    //         }
    //         // Cek dan simpan penulis korespondensi jika ada
    //         if ($request->penulis_korespondensi) {
    //             $penelitian->penulis_korespondensi = $request->penulis_korespondensi;
    //         }

    //         $penelitian->save();

    //         if ($request->filled('anggota_penulis')) {
    //             // Hapus semua data lama di pivot table
    //             PenelitianAnggota::where('penelitian_id', $penelitian->id)->delete();

    //             // Simpan data anggota inventor baru
    //             foreach ($request->anggota_penulis as $anggota) {
    //                 if (str_starts_with($anggota, 'user_')) {
    //                     $anggotaId = str_replace('user_', '', $anggota);
    //                     $table = 'users';
    //                 } elseif (str_starts_with($anggota, 'anggota_')) {
    //                     $anggotaId = str_replace('anggota_', '', $anggota);
    //                     $table = 'anggota_kelompok_keahlians';
    //                 } else {
    //                     continue; // Skip jika format tidak sesuai
    //                 }

    //                 PenelitianAnggota::create([
    //                     'penelitian_id' => $penelitian->id,
    //                     'anggota_id' => $anggotaId,
    //                     'anggota_type' => $table,
    //                 ]);
    //             }
    //         }
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Penelitian berhasil diupdate.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan : ' . $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function updatePenelitian(Request $request, $id)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'abstrak' => 'required|string',
                'penulis' => 'nullable|string|max:255',
                'penulis_lainnya' => 'nullable|string|max:255',
                'penulis_korespondensi_select' => 'nullable|string|max:255|required_without:penulis_korespondensi_lainnya',
                'penulis_korespondensi_lainnya' => 'nullable|string|max:255|required_without:penulis_korespondensi_select',
                'email_penulis' => 'required|email',
                'gambar' => 'file|mimes:jpeg,png,jpg|max:10240',
                'lampiran' => 'file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
                'tanggal_publikasi' => 'date',
            ], [
                'judul.required' => 'Judul penelitian wajib diisi.',
                'email_penulis.required' => 'Email penulis wajib diisi.',
                'email_penulis.email' => 'Email penulis tidak valid.',
                'abstrak.required' => 'Abstrak penelitian wajib diisi.',
                'penulis_korespondensi_select.required_without' => 'Silakan pilih penulis korespondensi atau isi manual.',
                'penulis_korespondensi_lainnya.required_without' => 'Silakan pilih penulis korespondensi atau isi manual.',
            ]);

            $penelitian = Penelitian::findOrFail($id);

            // Update data utama
            $penelitian->judul = $request->judul;
            $penelitian->abstrak = $request->abstrak;
            $penelitian->penulis = $request->penulis;
            $penelitian->penulis_lainnya = $request->penulis_lainnya;
            $penelitian->email_penulis = $request->email_penulis;
            $penelitian->tanggal_publikasi = $request->tanggal_publikasi;
            $penelitian->anggota_penulis_lainnya = $request->anggota_penulis_lainnya;

            // Tentukan penulis korespondensi
            $penulisKorespondensi = $request->penulis_korespondensi_select ?: $request->penulis_korespondensi_lainnya;
            $penelitian->penulis_korespondensi = $penulisKorespondensi;

            // Proses upload gambar baru
            if ($request->hasFile('gambar')) {
                if ($penelitian->gambar && Storage::exists($penelitian->gambar)) {
                    Storage::delete($penelitian->gambar);
                }
                $fileName = time() . '_' . str_replace(' ', '_', $request->file('gambar')->getClientOriginalName());
                $penelitian->gambar = $request->file('gambar')->storeAs('dokumen-penelitian', $fileName);
            }

            // Proses upload lampiran baru
            if ($request->hasFile('lampiran')) {
                if ($penelitian->lampiran && Storage::exists($penelitian->lampiran)) {
                    Storage::delete($penelitian->lampiran);
                }

                // Upload file baru
                $originalName = $request->file('lampiran')->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                $path = $request->file('lampiran')->storeAs('dokumen-penelitian', $fileName);
                $penelitian->lampiran = $path;
            }

            $penelitian->save();

            if ($request->filled('anggota_penulis')) {
                // Hapus semua data lama di pivot table
                PenelitianAnggota::where('penelitian_id', $penelitian->id)->delete();

                // Simpan data anggota inventor baru
                foreach ($request->anggota_penulis as $anggota) {
                    if (str_starts_with($anggota, 'user_')) {
                        $anggotaId = str_replace('user_', '', $anggota);
                        $table = 'users';
                    } elseif (str_starts_with($anggota, 'anggota_')) {
                        $anggotaId = str_replace('anggota_', '', $anggota);
                        $table = 'anggota_kelompok_keahlians';
                    } else {
                        continue; // Skip jika format tidak sesuai
                    }

                    PenelitianAnggota::create([
                        'penelitian_id' => $penelitian->id,
                        'anggota_id' => $anggotaId,
                        'anggota_type' => $table,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Penelitian berhasil diupdate.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function hapusPenelitian($id)
    {
        $penelitian = Penelitian::findOrFail($id);

        if ($penelitian->gambar && Storage::exists($penelitian->gambar)) {
            Storage::delete($penelitian->gambar);
        }

        // Hapus lampiran jika ada
        if ($penelitian->lampiran && Storage::exists($penelitian->lampiran)) {
            Storage::delete($penelitian->lampiran);
        }
        $penelitian->delete();
        return redirect('/k-kbk/penelitian')->with('success', 'Data Penelitian berhasil dihapus');
    }

    public function profil()
    {

        return view('produkinovasi::k_kbk.profil.index');
    }

    public function editProfil()
    {
        return view('produkinovasi::k_kbk.profil.edit.index');
    }


    public function updateProfil(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'jabatan' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|max:15',
            'pas_foto' => 'file|mimes:jpg,jpeg,png|max:2048',
            'username' => 'required|string|max:255',
            'password_last' => 'required|string', // Validasi password terakhir
        ]);

        $user = User::find($id);

        // Cek apakah password terakhir yang dimasukkan sesuai
        if (!Hash::check($request->password_last, $user->password)) {
            return redirect()->back()->withErrors(['password_last' => 'Password terakhir salah.']);
        }

        // Cek perubahan data
        if ($request->filled('nama_lengkap')) {
            $user->nama_lengkap = $request->nama_lengkap;
        }
        if ($request->filled('nip')) {
            $user->nip = $request->nip;
        }
        if ($request->filled('jabatan')) {
            $user->jabatan = $request->jabatan;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('no_hp')) {
            $user->no_hp = $request->no_hp;
        }
        if ($request->filled('username')) {
            $user->username = $request->username;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('pas_foto')) {
            if ($user->pas_foto && Storage::exists($user->pas_foto)) {
                Storage::delete($user->pas_foto);
            }
            $originalName = $request->file('pas_foto')->getClientOriginalName();
            $fileName = time() . '_' . str_replace(' ', '_', $originalName);

            // Simpan file dengan nama kustom
            $path = $request->file('pas_foto')->storeAs('dokumen-user', $fileName);

            // Simpan path tanpa 'public/' di database
            $user->pas_foto = $path;
        }

        $user->save();

        return redirect('/k-kbk/profil')->with('success', 'Data ketua kbk berhasil diperbaharui');
    }

    public function ubahPasswordUser(Request $request, $id)
    {
        // Menampilkan view form ubah password
        return view('produkinovasi::k_kbk.profil.ubahPassword.index');
    }

    public function prosesUbahPassword(Request $request, $id)
    {
        $request->validate([
            'password_lama' => 'required|string',
            'password_baru' => 'required|string|min:5|confirmed', // Pastikan ada konfirmasi
        ]);

        $user = User::find($id);

        // Cek apakah password lama sesuai
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password lama salah.']);
        }

        // Update password baru
        $user->password = bcrypt($request->password_baru);
        $user->save();

        return redirect('/k-kbk/profil')->with('success', 'Password berhasil diubah.');
    }
}
