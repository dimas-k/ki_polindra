<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paten;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paten = Paten::with('cek')->latest()->paginate(5);
        $pf = Paten::where('status', 'Pemeriksaan Formalitas')->count();
        $mt = Paten::where('status', 'Menunggu Tanggapan Formalitas')->count();
        $mp = Paten::where('status', 'Masa pengumuman')->count();
        $mps = Paten::where('status', 'Menunggu Pembayaran Substansif')->count();
        $staw = Paten::where('status', 'Substansif Tahap Awal')->count();
        $stl = Paten::where('status', 'Substansif Tahap Lanjut')->count();
        $stak = Paten::where('status', 'Substansif Tahap Akhir')->count();
        $mts = Paten::where('status', 'Menunggu Tanggapan Substansif')->count();
        $mvdov = Paten::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();
        $beri = Paten::where('status', 'Diberi')->count();
        $tolak = Paten::where('status', 'Ditolak')->count();
        return view('admin.adminpaten.index', compact('paten', 'pf', 'mt', 'mp', 'mps', 'staw', 'stl', 'stak', 'mts', 'beri', 'tolak', 'mvdov'));
    }
    public function cariPaten(Request $request)
    {
        $cari = $request->input('cari');
        $paten = Paten::with('cek')->where('judul_paten', 'LIKE', "%" . $cari . "%")->orWhere('nama_lengkap', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%")->orWhere('institusi', 'LIKE', "%" . $cari . "%")->paginate(5);
        $pf = Paten::where('status', 'Pemeriksaan Formalitas')->count();
        $mt = Paten::where('status', 'Menunggu Tanggapan Formalitas')->count();
        $mp = Paten::where('status', 'Masa pengumuman')->count();
        $mps = Paten::where('status', 'Menunggu Pembayaran Substansif')->count();
        $staw = Paten::where('status', 'Substansif Tahap Awal')->count();
        $stl = Paten::where('status', 'Substansif Tahap Lanjut')->count();
        $stak = Paten::where('status', 'Substansif Tahap Akhir')->count();
        $mts = Paten::where('status', 'Menunggu Tanggapan Substansif')->count();
        $beri = Paten::where('status', 'Diberi')->count();
        $tolak = Paten::where('status', 'Ditolak')->count();
        $mvdov = Paten::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();
        return view('admin.adminpaten.index', compact('paten', 'pf', 'mt', 'mp', 'mps', 'staw', 'stl', 'stak', 'mts', 'beri', 'tolak', 'mvdov'));
    }

    public function pemeriksaanFormalitas()
    {
        $cek = Paten::latest()->where('status', 'Pemeriksaan Formalitas')->get();
        return view('admin.adminpaten.admin-paten-pf.index', compact('cek'));
    }

    public function menungguTanggapan()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Tanggapan Formalitas')->get();
        return view('admin.adminpaten.admin-paten-mt.index', compact('cek'));
    }

    public function masaPengumuman()
    {
        $cek = Paten::latest()->where('status', 'Masa Pengumuman')->get();
        return view('admin.adminpaten.admin-paten-mp.index', compact('cek'));
    }

    public function pembayaranSubstansif()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Pembayaran Substansif')->get();
        return view('admin.adminpaten.admin-paten-mps.index', compact('cek'));
    }

    public function substansifAwal()
    {
        $cek = Paten::latest()->where('status', 'Substansif Tahap Awal')->get();
        return view('admin.adminpaten.admin-paten-staw.index', compact('cek'));
    }

    public function substansifLanjut()
    {
        $cek = Paten::latest()->where('status', 'Substansif Tahap Lanjut')->get();
        return view('admin.adminpaten.admin-paten-stl.index', compact('cek'));
    }
    public function substansifAkhir()
    {
        $cek = Paten::latest()->where('status', 'Substansif Tahap Akhir')->get();
        return view('admin.adminpaten.admin-paten-stak.index', compact('cek'));
    }
    public function mengungguTanggapanSubstansif()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Tanggapan Substansif')->get();
        return view('admin.adminpaten.admin-paten-mts.index', compact('cek'));
    }
    public function diberi()
    {
        $cek = Paten::latest()->where('status', 'Diberi')->get();
        return view('admin.adminpaten.admin-paten-beri.index', compact('cek'));
    }
    public function ditolak()
    {
        $cek = Paten::latest()->where('status', 'Ditolak')->get();
        return view('admin.adminpaten.admin-paten-tlk.index', compact('cek'));
    }
    public function mvdov()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->paginate(5);
        return view('admin.adminpaten.admin-paten-mvdov.index', compact('cek'));
    }

    public function tambahPatenDosen()
    {
        $users = DB::table('users')
            ->select('id', 'nama_lengkap')
            ->where('role', '=', 'Dosen')
            ->get();
        // dd($users);
        return view('admin.adminpaten.tambah.dosen', compact('users'));
    }
    public function tambahPatenUmum()
    {
        $users = DB::table('users')
            ->select('id', 'nama_lengkap')
            ->Where('role', '=', 'Umum')
            ->get();
        return view('admin.adminpaten.tambah.umum', compact('users'));
    }

    public function storeTambahPatenDosen(Request $request)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'user_id' => 'required|exists:users,id',
            'alamat' => 'required',
            'no_telepon' => 'required|max:14',
            'tanggal_lahir' => 'required|date',
            'ktp_inventor' => 'required|mimes:pdf|max:2028',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required|integer',
            'data_pengaju2' => 'mimes:xlsx',
            'institusi' => 'required',
            'jurusan' => 'required|exists:jurusan,nama_jurusan',
            'prodi' => 'required|exists:prodi,nama_prodi',
            'jenis_paten' => 'required',
            'judul_paten' => 'required',
            'deskripsi_paten' => 'required|mimes:pdf|max:2028',
            'abstrak_paten' => 'required|mimes:pdf|max:2028',
            'pengalihan_hak' => 'required|mimes:pdf|max:2028',
            'klaim' => 'required|mimes:pdf|max:2028',
            'pernyataan_kepemilikan' => 'required|mimes:pdf|max:2028',
            'surat_kuasa' => 'required|mimes:pdf|max:2028',
            'gambar_paten' => 'required|mimes:pdf|max:2028',
            'gambar_tampilan' => 'required|mimes:pdf|max:2028',
            'tanggal_permohonan' => 'required'
        ]);
        $paten = new Paten();
        $paten->user_id = $request->user_id;
        $paten->nama_lengkap = $request->nama_lengkap;
        $paten->alamat = $request->alamat;
        $paten->no_telepon = $request->no_telepon;
        $paten->tanggal_lahir = $request->tanggal_lahir;
        $paten->email = $request->email;
        $paten->kewarganegaraan = $request->kewarganegaraan;
        $paten->kode_pos = $request->kode_pos;
        $paten->institusi = $request->institusi;
        $paten->jurusan = $request->jurusan;
        $paten->prodi = $request->prodi;
        $paten->prodi_id = Prodi::findIdByName($request->prodi);
        $paten->jenis_paten = $request->jenis_paten;
        $paten->judul_paten = $request->judul_paten;
        $paten->tanggal_permohonan = $request->tanggal_permohonan;

        // Daftar file yang disimpan di public storage
        $publicFiles = ['deskripsi_paten', 'abstrak_paten', 'gambar_paten', 'gambar_tampilan'];
        // Daftar file yang disimpan di private storage
        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'data_pengaju2' => 'data_pengaju2',
            'pengalihan_hak' => 'pengalihan_hak',
            'klaim' => 'klaim',
            'pernyataan_kepemilikan' => 'pernyataan_kepemilikan',
            'surat_kuasa' => 'surat_kuasa',
        ];
        // Proses unggahan file ke private storage
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'private' dalam folder 'dosen/dokumen-paten'
                $path = $file->storeAs('dokumen-paten', $filename, 'private');
                $paten->{$storageName} = $path;
            }
        }
        // Proses unggahan file ke public storage
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'public' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-paten', $filename, 'public');
                $paten->{$field} = $path;
            }
        }

        $paten->save($validasidata);

        return redirect('/admin/paten')->with('success', 'Data Paten Berhasil Ditambahkan');
    }



    public function storeTambahPatenUmum(Request $request)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'user_id' => 'required|exists:users,id',
            'alamat' => 'required',
            'no_telepon' => 'required|max:14',
            'tanggal_lahir' => 'required|date',
            'ktp_inventor' => 'required|mimes:pdf|max:2028',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required|integer',
            'institusi' => 'required',
            'jenis_paten' => 'required',
            'judul_paten' => 'required',
            'deskripsi_paten' => 'required|mimes:pdf|max:2028',
            'abstrak_paten' => 'required|mimes:pdf|max:2028',
            'pengalihan_hak' => 'required|mimes:pdf|max:2028',
            'klaim' => 'required|mimes:pdf|max:2028',
            'pernyataan_kepemilikan' => 'required|mimes:pdf|max:2028',
            'surat_kuasa' => 'required|mimes:pdf|max:2028',
            'gambar_paten' => 'required|mimes:pdf|max:2028',
            'gambar_tampilan' => 'required|mimes:pdf|max:2028',
            'tanggal_permohonan' => 'required'
        ]);
        $paten = new Paten();
        $paten->user_id = $request->user_id;
        $paten->nama_lengkap = $request->nama_lengkap;
        $paten->alamat = $request->alamat;
        $paten->no_telepon = $request->no_telepon;
        $paten->tanggal_lahir = $request->tanggal_lahir;
        $paten->email = $request->email;
        $paten->kewarganegaraan = $request->kewarganegaraan;
        $paten->kode_pos = $request->kode_pos;
        $paten->institusi = $request->institusi;
        $paten->jenis_paten = $request->jenis_paten;
        $paten->judul_paten = $request->judul_paten;
        $paten->tanggal_permohonan = $request->tanggal_permohonan;

        // Daftar file yang disimpan di public storage
        $publicFiles = ['deskripsi_paten', 'abstrak_paten', 'gambar_paten', 'gambar_tampilan'];
        // Daftar file yang disimpan di private storage
        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'pengalihan_hak' => 'pengalihan_hak',
            'klaim' => 'klaim',
            'pernyataan_kepemilikan' => 'pernyataan_kepemilikan',
            'surat_kuasa' => 'surat_kuasa',
        ];
        // Proses unggahan file ke private storage
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'private' dalam folder 'dosen/dokumen-paten'
                $path = $file->storeAs('dokumen-paten', $filename, 'private');
                $paten->{$storageName} = $path;
            }
        }
        // Proses unggahan file ke public storage
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'public' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-paten', $filename, 'public');
                $paten->{$field} = $path;
            }
        }

        $paten->save($validasidata);
        return redirect('/admin/paten')->with('success', 'Data Paten Berhasil Ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cari(Request $request) {}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $p = Paten::with('cek')->find($id);
        // dd($p->sertifikat_paten);

        return view('admin.adminpaten.showpaten.index', compact('p'));
    }

    public function viewSensitifFilesPaten($filename)
    {
        // Path file di disk 'private'
        $filePaten = storage_path('app/private/dokumen-paten/' . $filename);

        // Pastikan file ada
        if (!file_exists($filePaten)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Cari data paten berdasarkan salah satu kolom file
        $paten = Paten::where(function ($query) use ($filename) {
            $query->where('ktp_inventor', 'dokumen-paten/' . $filename)
                ->orWhere('data_pengaju2', 'dokumen-paten/' . $filename)
                ->orWhere('pengalihan_hak', 'dokumen-paten/' . $filename)
                ->orWhere('klaim', 'dokumen-paten/' . $filename)
                ->orWhere('pernyataan_kepemilikan', 'dokumen-paten/' . $filename)
                ->orWhere('surat_kuasa', 'dokumen-paten/' . $filename);
        })->first();
        // Validasi akses: hanya pemilik atau Admin yang bisa melihat file vital
        if (!$paten) {
            abort(404, 'File tidak ditemukan.');
        }
        if ($paten->user_id !== auth()->id() && auth()->user()->role !== 'Admin') {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }
        // Kirim file sebagai respons
        return response()->file($filePaten);
    }

    public function viewPublicFilesPaten($filename)
    {
        // Path file di disk 'private'
        $filePaten = storage_path('app/public/dokumen-paten/' . $filename);

        // Pastikan file ada
        if (!file_exists($filePaten)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Cari data paten berdasarkan salah satu kolom file
        $paten = Paten::where(function ($query) use ($filename) {
            $query->Where('abstrak_paten', 'dokumen-paten/' . $filename)
                ->orWhere('deskripsi_paten', 'dokumen-paten/' . $filename)
                ->orWhere('gambar_paten', 'dokumen-paten/' . $filename)
                ->orWhere('gambar_tampilan', 'dokumen-paten/' . $filename)
                ->orWhere('sertifikat_paten', 'dokumen-paten/' . $filename);
        })->first();
        // Validasi akses: hanya pemilik atau admin/verifikator yang bisa melihat
        if (!$paten || ($paten->user_id !== auth()->id() && !in_array(auth()->user()->role, ['Checker', 'Admin']))) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Kirim file sebagai respons
        return response()->file($filePaten);
    }

    public function viewFilesPaten($filename)
    {
        // Path file di disk 'private'
        $filePaten = storage_path('app/public/dokumen-paten/' . $filename);

        // Pastikan file ada
        if (!file_exists($filePaten)) {
            abort(404, 'File tidak ditemukan.');
        }
        // Cari data paten berdasarkan salah satu kolom file
        $paten = Paten::where(function ($query) use ($filename) {
            $query
                ->Where('abstrak_paten', 'dokumen-paten/' . $filename)
                ->orWhere('deskripsi_paten', 'dokumen-paten/' . $filename)
                ->orWhere('gambar_paten', 'dokumen-paten/' . $filename)
                ->orWhere('gambar_tampilan', 'dokumen-paten/' . $filename)
                ->orWhere('sertifikat_paten', 'dokumen-paten/' . $filename);
        })->first();
        // Validasi akses: hanya pemilik atau admin/verifikator yang bisa melihat
        // if (!$paten || $paten->user_id !== auth()->id()) {
        //     abort(403, 'Anda tidak memiliki akses ke file ini.');
        // }
        if (!$paten || ($paten->user_id !== auth()->id() && auth()->user()->role !== 'Admin')) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Kirim file sebagai respons
        return response()->file($filePaten);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $p = Paten::find($id);
        if ($p->institusi === 'Dosen') {
            return view('admin.adminpaten.editpaten.index', compact('p'));
        } else if ($p->institusi === 'Umum') {
            return view('admin.adminpaten.editpaten.umum', compact('p'));
        }
    }

    // public function updateData(Request $request, string $id)
    // {
    //     // Validasi input
    //     $validasidata = $request->validate([
    //         'nama_lengkap' => 'required',
    //         'alamat' => 'required',
    //         'no_telepon' => 'required|max:14',
    //         'tanggal_lahir' => 'required|date',
    //         'ktp_inventor' => 'nullable|mimes:pdf|max:2028',
    //         'email' => 'required|email',
    //         'kewarganegaraan' => 'required',
    //         'kode_pos' => 'required|integer',
    //         'data_pengaju2' => 'nullable|mimes:xlsx',
    //         'institusi' => 'required|string',
    //         'jurusan' => 'required',
    //         'prodi' => 'required',
    //         'jenis_paten' => 'required',
    //         'judul_paten' => 'required',
    //         'deskripsi_paten' => 'nullable|mimes:pdf|max:2028',
    //         'abstrak_paten' => 'nullable|mimes:pdf|max:2028',
    //         'pengalihan_hak' => 'nullable|mimes:pdf|max:2028',
    //         'klaim' => 'nullable|mimes:pdf|max:2028',
    //         'pernyataan_kepemilikan' => 'nullable|mimes:pdf|max:2028',
    //         'surat_kuasa' => 'nullable|mimes:pdf|max:2028',
    //         'gambar_paten' => 'nullable|mimes:pdf|max:2028',
    //         'gambar_tampilan' => 'nullable|mimes:pdf|max:2028',
    //         'tanggal_permohonan' => 'required'
    //     ]);

    //     try {
    //         // Cari data paten berdasarkan ID
    //         $paten = Paten::findOrFail($id);

    //         // Perbarui field non-file
    //         $paten->nama_lengkap = $request->nama_lengkap;
    //         $paten->alamat = $request->alamat;
    //         $paten->no_telepon = $request->no_telepon;
    //         $paten->tanggal_lahir = $request->tanggal_lahir;
    //         $paten->email = $request->email;
    //         $paten->kewarganegaraan = $request->kewarganegaraan;
    //         $paten->kode_pos = $request->kode_pos;
    //         $paten->institusi = $request->institusi;
    //         $paten->jurusan = $request->jurusan;
    //         $paten->prodi = $request->prodi;
    //         $paten->jenis_paten = $request->jenis_paten;
    //         $paten->judul_paten = $request->judul_paten;
    //         $paten->tanggal_permohonan = $request->tanggal_permohonan;

    //         // Daftar field file untuk di-update
    //         $privateFiles = [
    //             'ktp_inventor' => 'ktp_inventor',
    //             'data_pengaju2' => 'data_pengaju2',
    //             'pengalihan_hak' => 'pengalihan_hak',
    //             'klaim' => 'klaim',
    //             'pernyataan_kepemilikan' => 'pernyataan_kepemilikan',
    //             'surat_kuasa' => 'surat_kuasa'
    //         ];
    //         $publicFiles = ['deskripsi_paten', 'abstrak_paten', 'gambar_paten', 'gambar_tampilan'];

    //         // Perbarui file jika ada yang diunggah
    //         foreach ($privateFiles as $field => $storageName) {
    //             if ($request->hasFile($field)) {
    //                 // Hapus file lama jika ada
    //                 if ($paten->{$storageName}) {
    //                     Storage::delete($paten->{$storageName});
    //                 }
    //                 $file = $request->file($field);
    //                 $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    //                 // Simpan di disk 'private' dalam folder 'dosen/dokumen-paten'
    //                 $path = $file->storeAs('dokumen-paten', $filename, 'private');
    //                 $paten->{$storageName} = $path;
    //             }
    //         }
    //         foreach ($publicFiles as $field => $storageName) {
    //             if ($request->hasFile($field)) {
    //                 // Hapus file lama jika ada
    //                 if ($paten->{$storageName}) {
    //                     Storage::delete($paten->{$storageName});
    //                 }
    //                 $file = $request->file($field);
    //                 $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    //                 // Simpan di disk 'private' dalam folder 'dosen/dokumen-paten'
    //                 $path = $file->storeAs('dokumen-paten', $filename, 'public');
    //                 $paten->{$storageName} = $path;
    //             }
    //         }

    //         // Simpan perubahan ke database
    //         $paten->save($validasidata);

    //         // Redirect dengan pesan sukses
    //         return redirect('/admin/paten')->with('success', 'Data Paten berhasil diperbarui!');
    //     } catch (\Exception $e) {
    //         // Log error dan tampilkan pesan error
    //         Log::error('Error saat mengupdate paten: ' . $e->getMessage());
    //         return redirect('/admin/paten')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }

    // return redirect('/admin/paten')->with('success', 'Data paten berhasil di update');


    public function updateData(Request $request, string $id)
    {
        // Validasi input; untuk file diupdate, gunakan aturan 'nullable' agar tidak wajib diunggah ulang
        $request->validate([
            'nama_lengkap'              => 'required',
            'alamat'                    => 'required',
            'no_telepon'                => 'required|max:14',
            'tanggal_lahir'             => 'required|date',
            'ktp_inventor'              => 'nullable|mimes:pdf|max:2028',
            'email'                     => 'required|email',
            'kewarganegaraan'           => 'required',
            'kode_pos'                  => 'required|integer',
            'data_pengaju2'             => 'nullable|mimes:xlsx',
            'institusi'                 => 'required|string',
            'jurusan'                   => 'required|exists:jurusan,nama_jurusan',
            'prodi'                     => 'required|exists:prodi,nama_prodi',
            'jenis_paten'               => 'required',
            'judul_paten'               => 'required',
            'deskripsi_paten'           => 'nullable|mimes:pdf|max:2028',
            'abstrak_paten'             => 'nullable|mimes:pdf|max:2028',
            'pengalihan_hak'            => 'nullable|mimes:pdf|max:2028',
            'klaim'                     => 'nullable|mimes:pdf|max:2028',
            'pernyataan_kepemilikan'    => 'nullable|mimes:pdf|max:2028',
            'surat_kuasa'               => 'nullable|mimes:pdf|max:2028',
            'gambar_paten'              => 'nullable|mimes:pdf|max:2028',
            'gambar_tampilan'           => 'nullable|mimes:pdf|max:2028',
            'tanggal_permohonan'        => 'required'
        ]);

        // Temukan data Paten yang akan diupdate
        $paten = Paten::findOrFail($id);

        // Update field yang tidak terkait file
        $paten->nama_lengkap         = $request->nama_lengkap;
        $paten->alamat               = $request->alamat;
        $paten->no_telepon           = $request->no_telepon;
        $paten->tanggal_lahir        = $request->tanggal_lahir;
        $paten->email                = $request->email;
        $paten->kewarganegaraan      = $request->kewarganegaraan;
        $paten->kode_pos             = $request->kode_pos;
        $paten->institusi            = $request->institusi;
        $paten->jurusan              = $request->jurusan;
        $paten->prodi                = $request->prodi;
        $paten->jenis_paten          = $request->jenis_paten;
        $paten->judul_paten          = $request->judul_paten;
        $paten->tanggal_permohonan   = $request->tanggal_permohonan;

        $privateFiles = [
            'ktp_inventor'           => 'ktp_inventor',
            'data_pengaju2'          => 'data_pengaju2',
            'pengalihan_hak'         => 'pengalihan_hak',
            'klaim'                  => 'klaim',
            'pernyataan_kepemilikan' => 'pernyataan_kepemilikan',
            'surat_kuasa'            => 'surat_kuasa'
        ];

        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                // Jika ada file lama, hapus dari disk 'private'
                if ($paten->{$storageName}) {
                    Storage::disk('private')->delete($paten->{$storageName});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-paten' pada disk 'private'
                $path = $file->storeAs('dokumen-paten', $filename, 'private');
                $paten->{$storageName} = $path;
            }
        }

        $publicFiles = ['deskripsi_paten', 'abstrak_paten', 'gambar_paten', 'gambar_tampilan'];
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                if ($paten->{$field}) {
                    Storage::disk('public')->delete($paten->{$field});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-paten' pada disk 'public'
                $path = $file->storeAs('dokumen-paten', $filename, 'public');
                $paten->{$field} = $path;
            }
        }

        // Simpan perubahan ke database
        $paten->save();

        return redirect('/admin/paten')->with('success', 'Data Paten berhasil diupdate!');
    }

    public function updateDataUmum(Request $request, string $id)
    {
        // Validasi input data
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|max:14',
            'tanggal_lahir' => 'required|date',
            'ktp_inventor' => 'required|mimes:pdf|max:2028',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required|integer',
            'institusi' => 'required',
            'jenis_paten' => 'required',
            'judul_paten' => 'required',
            'deskripsi_paten' => 'required|mimes:pdf|max:2028',
            'abstrak_paten' => 'required|mimes:pdf|max:2028',
            'pengalihan_hak' => 'required|mimes:pdf|max:2028',
            'klaim' => 'required|mimes:pdf|max:2028',
            'pernyataan_kepemilikan' => 'required|mimes:pdf|max:2028',
            'surat_kuasa' => 'required|mimes:pdf|max:2028',
            'gambar_paten' => 'required|mimes:pdf|max:2028',
            'gambar_tampilan' => 'required|mimes:pdf|max:2028',
            'tanggal_permohonan' => 'required'
        ]);

        // Cari data paten berdasarkan ID
        $paten = Paten::findOrFail($id);
        $paten->nama_lengkap = $request->nama_lengkap;
        $paten->alamat = $request->alamat;
        $paten->no_telepon = $request->no_telepon;
        $paten->tanggal_lahir = $request->tanggal_lahir;
        $paten->email = $request->email;
        $paten->kewarganegaraan = $request->kewarganegaraan;
        $paten->kode_pos = $request->kode_pos;
        $paten->institusi = $request->institusi;
        $paten->jenis_paten = $request->jenis_paten;
        $paten->judul_paten = $request->judul_paten;
        $paten->tanggal_permohonan = $request->tanggal_permohonan;

        // Daftar field file untuk di-update
        $privateFiles = [
            'ktp_inventor'           => 'ktp_inventor',
            'pengalihan_hak'         => 'pengalihan_hak',
            'klaim'                  => 'klaim',
            'pernyataan_kepemilikan' => 'pernyataan_kepemilikan',
            'surat_kuasa'            => 'surat_kuasa'
        ];

        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                // Jika ada file lama, hapus dari disk 'private'
                if ($paten->{$storageName}) {
                    Storage::disk('private')->delete($paten->{$storageName});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-paten' pada disk 'private'
                $path = $file->storeAs('dokumen-paten', $filename, 'private');
                $paten->{$storageName} = $path;
            }
        }

        $publicFiles = ['deskripsi_paten', 'abstrak_paten', 'gambar_paten', 'gambar_tampilan'];
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                if ($paten->{$field}) {
                    Storage::disk('public')->delete($paten->{$field});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-paten' pada disk 'public'
                $path = $file->storeAs('dokumen-paten', $filename, 'public');
                $paten->{$field} = $path;
            }
        }
        // Simpan perubahan ke database
        $paten->save($validasidata);

        return redirect('/admin/paten')->with('success', 'Data paten berhasil di update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input, file sertifikat_paten bersifat opsional
        $data = $request->validate([
            'status' => 'required',
            'sertifikat_paten' => 'nullable|mimes:pdf'
        ]);

        // Cari data paten, jika tidak ditemukan otomatis error 404
        $paten = Paten::findOrFail($id);

        // Update status
        $paten->status = $data['status'];

        // Daftar field file yang ingin diproses
        $publicFiles = [
            // key: nama field di form, value: properti model yang akan diisi
            'sertifikat_paten' => 'sertifikat_paten'
        ];

        foreach ($publicFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                // Buat nama file baru dengan timestamp dan mengganti spasi dengan underscore
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file di disk 'private' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-paten', $filename, 'public');
                // Set nilai properti model sesuai dengan $storageName
                $paten->{$storageName} = $path;
            }
        }

        // Simpan perubahan ke database
        $paten->save();

        return redirect('/admin/paten')->with('success', 'Status paten berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy2(string $id)
    {
        Paten::with('cek')->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data paten berhasil dihapus');
    }
    public function destroy(string $id)
    {
        $paten = Paten::with('cek')->findOrFail($id);
        $paten->delete();
        return redirect()->back()->with('success', 'Data paten dan file-file terkait berhasil dihapus');
    }
}
