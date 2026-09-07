<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers;

use App\Models\HakCipta;
use App\Models\Prodi;
use App\Services\KirimKeDashboardService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminHaKCiptaController extends Controller
{
    public function index()
    {
        $tercatat = HakCipta::where('status', 'Tercatat')->count();
        $tolak = HakCipta::where('status', 'Ditolak')->count();
        $null = HakCipta::where('status', 'Keterangan Belum Lengkap')->count();
        $mvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator ')->count();
        $hak_cipta = HakCipta::with('cekhc')->latest()->paginate(5);
        return view('kekayaanintelektual::admin.adminhk.index', compact('hak_cipta','tercatat','null','tolak','mvdov'));
    }

    public function listTercatat()
    {
        $cek = HakCipta::latest()->where('status', 'Tercatat')->get();
        return view('kekayaanintelektual::admin.adminhk.admin-hc-tercatat.index', compact('cek'));
    }
    public function belumLengkap()
    {
        $cek = HakCipta::latest()->where('status', 'Keterangan Belum Lengkap')->get();
        return view('kekayaanintelektual::admin.adminhk.admin-hc-kbl.index', compact('cek'));
    }
    public function tolak()
    {
        $cek = HakCipta::latest()->where('status', 'Ditolak')->get();
        return view('kekayaanintelektual::admin.adminhk.admin-hc-t.index', compact('cek'));
    }
    public function mvdov()
    {
        $mvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->paginate(5);
        return view('kekayaanintelektual::admin.adminhk.admin-hc-mvdov.index', compact('mvdov'));
    }
    public function cariHk(Request $request)
    {
        $cari = $request->input('cari');
        $hak_cipta = HakCipta::with('cekhc')->where('judul_ciptaan', 'LIKE', "%" . $cari . "%")->orWhere('nama_lengkap', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%")->orWhere('institusi', 'LIKE', "%" . $cari . "%")->paginate(5);
        $tercatat = HakCipta::where('status', 'Tercatat')->count();
        $tolak = HakCipta::where('status', 'Ditolak')->count();
        $null = HakCipta::where('status', 'Keterangan Belum Lengkap')->count();
        $mvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator ')->count();

        return view('kekayaanintelektual::admin.adminhk.index', compact('hak_cipta','tercatat','null','tolak', 'mvdov'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
        $hc = HakCipta::with('cekhc')->find($id);
        // dd($hc);
        return view('kekayaanintelektual::admin.adminhk.showhc.index', compact('hc'));
    }

    public function viewPublicFilesHc($filename)
    {
        // Path file di disk 'private'
        $fileHc = storage_path('app/public/dokumen-hc/' . $filename);

        // Pastikan file ada
        if (!file_exists($fileHc)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Cari data paten berdasarkan salah satu kolom file
        $hc = HakCipta::where(function ($query) use ($filename) {
            $query->where('dokumen_invensi', 'dokumen-hc/' . $filename)
                ->orWhere('sertifikat_hakcipta', 'dokumen-hc/' . $filename);
        })->first();

        // Validasi akses: hanya pemilik atau admin/verifikator yang bisa melihat
        if (!$hc || ($hc->user_id !== auth()->id() && auth()->user()->role !== 'Admin')) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Kirim file sebagai respons
        return response()->file($fileHc);
    }
    public function viewSensitifFilesHc($filename)
    {
        // Path file di disk 'private'
        $fileHc = storage_path('app/private/dokumen-hc/' . $filename);

        // Pastikan file ada
        if (!file_exists($fileHc)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Cari data paten berdasarkan salah satu kolom file
        $hc = HakCipta::where(function ($query) use ($filename) {
            $query->where('ktp_inventor', 'dokumen-hc/' . $filename)
                ->orWhere('data_pengaju2', 'dokumen-hc/' . $filename)
                ->orWhere('surat_pengalihan', 'dokumen-hc/' . $filename)
                ->orWhere('surat_pernyataan', 'dokumen-hc/' . $filename);
        })->first();

        // Admin bisa melihat semua file vital
        if (!$hc) {
            abort(404, 'File tidak ditemukan.');
        }

        // Kirim file sebagai respons
        return response()->file($fileHc);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hk = HakCipta::find($id);
        if($hk->institusi === 'Dosen'){
            return view('kekayaanintelektual::admin.adminhk.edithk.dosen', compact('hk'));
        }else if($hk->institusi === 'Umum'){
            return view('kekayaanintelektual::admin.adminhk.edithk.umum', compact('hk'));
        }
    }
    public function updateHcDosen(Request $request, string $id)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required|string',
            'alamat' => 'required',
            'no_telepon' => 'required|max:14',
            'tanggal_lahir' => 'required|date',
            'ktp_inventor' => 'nullable|mimes:pdf|max:2028',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required|integer',
            'institusi' => 'required|string',
            'data_pengaju2' => 'nullable|mimes:xlsx',
            'jurusan' => 'required|exists:jurusan,nama_jurusan',
            'prodi' => 'required|exists:prodi,nama_prodi',
            'jenis_ciptaan' => 'required',
            'judul_ciptaan' => 'required',
            'uraian_singkat' => 'required|max:60000',
            'dokumen_invensi' => 'nullable|mimes:pdf|max:2028',
            'surat_pengalihan' => 'nullable|mimes:pdf|max:2028',
            'surat_pernyataan' => 'nullable|mimes:pdf|max:2028',
            'tanggal_permohonan' => 'required|date'

        ]);

        try { 
            $hc = HakCipta::findOrFail($id);
            $hc->nama_lengkap = $request->nama_lengkap;
            $hc->alamat = $request->alamat;
            $hc->no_telepon = $request->no_telepon;
            $hc->tanggal_lahir = $request->tanggal_lahir;
            $hc->email = $request->email;
            $hc->kewarganegaraan = $request->kewarganegaraan;
            $hc->kode_pos = $request->kode_pos;
            $hc->institusi = $request->institusi;
            $hc->jurusan = $request->jurusan;
            $hc->prodi = $request->prodi;
            $hc->prodi_id = Prodi::findIdByName($request->prodi);
            $hc->jenis_ciptaan = $request->jenis_ciptaan;
            $hc->judul_ciptaan = $request->judul_ciptaan;
            $hc->uraian_singkat = $request->uraian_singkat;
            $hc->tanggal_permohonan = $request->tanggal_permohonan;
    
            $publicFiles = ['dokumen_invensi'];
            $privateFiles = [
                'ktp_inventor' => 'ktp_inventor',
                'data_pengaju2' => 'data_pengaju2',
                'surat_pengalihan' => 'surat_pengalihan',
                'surat_pernyataan' => 'surat_pernyataan',
            ];
    
            foreach ($privateFiles as $field => $storageName) {
                if ($request->hasFile($field)) {
                    // Jika ada file lama, hapus dari disk 'private'
                    if ($hc->{$storageName}) {
                        Storage::disk('private')->delete($hc->{$storageName});
                    }
                    $file = $request->file($field);
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    // Simpan file ke folder 'dokumen-paten' pada disk 'private'
                    $path = $file->storeAs('dokumen-hc', $filename, 'private');
                    $hc->{$storageName} = $path;
                }
            }
            foreach ($publicFiles as $field) {
                if ($request->hasFile($field)) {
                    if ($hc->{$field}) {
                        Storage::disk('public')->delete($hc->{$field});
                    }
                    $file = $request->file($field);
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    // Simpan file ke folder 'dokumen-hc' pada disk 'public'
                    $path = $file->storeAs('dokumen-hc', $filename, 'public');
                    $hc->{$field} = $path;
                }
            }
            $hc->save($validasidata);
            return redirect('/admin/hak-cipta')->with('success','Data hak cipta berhasil di update');
        } catch(\Exception $e) {
            Log::error('Error saat mengupdate Hak Cipta: ' . $e->getMessage());
            return redirect('/admin/hak-cipta')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function updateHcUmum(Request $request, string $id)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tanggal_lahir' => 'required',
            'ktp_inventor' => 'required|mimes:pdf',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required',
            'institusi' => 'required',
            'jenis_ciptaan' => 'required',
            'judul_ciptaan' => 'required',
            'uraian_singkat' => 'required|max:60000',
            'dokumen_invensi' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'surat_pernyataan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'

        ]);

        $hc = HakCipta::find($id);
        $hc->nama_lengkap = $request->nama_lengkap;
        $hc->alamat = $request->alamat;
        $hc->no_telepon = $request->no_telepon;
        $hc->tanggal_lahir = $request->tanggal_lahir;
        $hc->email = $request->email;
        $hc->kewarganegaraan = $request->kewarganegaraan;
        $hc->kode_pos = $request->kode_pos;
        $hc->institusi = $request->institusi;
        $hc->jenis_ciptaan = $request->jenis_ciptaan;
        $hc->judul_ciptaan = $request->judul_ciptaan;
        $hc->uraian_singkat = $request->uraian_singkat;
        $hc->tanggal_permohonan = $request->tanggal_permohonan;

        $publicFiles = ['dokumen_invensi'];
        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'surat_pengalihan' => 'surat_pengalihan',
            'surat_pernyataan' => 'surat_pernyataan',
        ];

        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                // Jika ada file lama, hapus dari disk 'private'
                if ($hc->{$storageName}) {
                    Storage::disk('private')->delete($hc->{$storageName});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-paten' pada disk 'private'
                $path = $file->storeAs('dokumen-hc', $filename, 'private');
                $hc->{$storageName} = $path;
            }
        }
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                if ($hc->{$field}) {
                    Storage::disk('public')->delete($hc->{$field});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-hc' pada disk 'public'
                $path = $file->storeAs('dokumen-hc', $filename, 'public');
                $hc->{$field} = $path;
            }
        }

        // Simpan perubahan ke database
        $hc->save($validasidata);
        return redirect('/admin/hak-cipta')->with('success','Data hak cipta berhasil di update');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update2(Request $request, string $id)
    {
        $validasidata = $request->validate([
           
            'sertifikat_hakcipta'=>'mimes:pdf'

        ]);
        $hc = HakCipta::find($id);
        $hc->status = $request->status;
        if ($request->file('sertifikat_hakcipta') == null) {
            $hc->sertifikat_hakcipta = "";
        }else{
           if ($request->hasFile('sertifikat_hakcipta')) {
                $file = $request->file('sertifikat_hakcipta');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $hc->sertifikat_hakcipta = $file->storeAs('dokumen-hc', $filename, 'public');
            }
        }
        $hc->save($validasidata);
        return redirect('/admin/hak-cipta')->with('success','Data hak cipta berhasil di update')
        ->withInput();
    }

    public function update(Request $request, string $id)
    {
        // Validasi input, file sertifikat_paten bersifat opsional
        $data = $request->validate([
            'status' => 'required',
            'sertifikat_hakcipta' => 'nullable|mimes:pdf'
        ]);

        // Cari data paten, jika tidak ditemukan otomatis error 404
        $hc = HakCipta::findOrFail($id);

        // Update status
        $hc->status = $data['status'];

        // Daftar field file yang ingin diproses
        $publicFiles = [
            // key: nama field di form, value: properti model yang akan diisi
            'sertifikat_hakcipta' => 'sertifikat_hakcipta'
        ];

        foreach ($publicFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                // Buat nama file baru dengan timestamp dan mengganti spasi dengan underscore
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file di disk 'private' dalam folder 'dokumen-hc'
                $path = $file->storeAs('dokumen-hc', $filename, 'public');
                // Set nilai properti model sesuai dengan $storageName
                $hc->{$storageName} = $path;
            }
        }

        // Simpan perubahan ke database
        $hc->save();

        return redirect('/admin/hak-cipta')->with('success', 'Status Hak Cipta berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy2(string $id)
    {
        HakCipta::with('cekhc')->findOrFail($id)->delete();
        return redirect()->back()->with('success','Data hak cipta berhasil dihapus');
    }

    public function destroy(string $id)
    {
        $hc = HakCipta::with('cekhc')->findOrFail($id);
        $hc->delete();
        return redirect()->back()->with('success', 'Data Hak Cipta dan file-file terkait berhasil dihapus');
    }

    public function tambahDosen()
    {
        $users = DB::table('users')
        ->select('id', 'nama_lengkap')
        ->where('role', '=', 'Dosen')
        ->get();
        return view('kekayaanintelektual::admin.adminhk.tambah.dosen', compact('users'));
    }
    public function tambahHcUmum()
    {
        $users = DB::table('users')
        ->select('id', 'nama_lengkap')
        ->where('role', '=', 'Umum')
        ->get();
        return view('kekayaanintelektual::admin.adminhk.tambah.umum', compact('users'));
    }

    public function storeTambahHcDosen(Request $request)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'user_id' => 'required|exists:users,id', 
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tanggal_lahir' => 'required',
            'ktp_inventor' => 'required|mimes:pdf',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required',
            'institusi' => 'required',
            'data_pengaju2' => 'mimes:xlsx',
            'jurusan' => 'required|exists:jurusan,nama_jurusan',
            'prodi' => 'required|exists:prodi,nama_prodi',
            'jenis_ciptaan' => 'required',
            'judul_ciptaan' => 'required',
            'uraian_singkat' => 'required|max:60000',
            'dokumen_invensi' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'surat_pernyataan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'

        ]);

        $hc = new HakCipta();
        $hc->user_id = $request->user_id;
        $hc->nama_lengkap = $request->nama_lengkap;
        $hc->alamat = $request->alamat;
        $hc->no_telepon = $request->no_telepon;
        $hc->tanggal_lahir = $request->tanggal_lahir;
        $hc->email = $request->email;
        $hc->kewarganegaraan = $request->kewarganegaraan;
        $hc->kode_pos = $request->kode_pos;
        $hc->institusi = $request->institusi;
        $hc->jurusan = $request->jurusan;
        $hc->prodi = $request->prodi;
        $hc->prodi_id = Prodi::findIdByName($request->prodi);
        $hc->jenis_ciptaan = $request->jenis_ciptaan;
        $hc->judul_ciptaan = $request->judul_ciptaan;
        $hc->uraian_singkat = $request->uraian_singkat;
        $hc->tanggal_permohonan = $request->tanggal_permohonan;

        $publicFiles = ['dokumen_invensi'];
        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'data_pengaju2' => 'data_pengaju2',
            'surat_pengalihan' => 'surat_pengalihan',
            'surat_pernyataan' => 'surat_pernyataan'
        ];

        // Proses unggahan file ke private storage
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'private' dalam folder '/dokumen-hc'
                $path = $file->storeAs('dokumen-hc', $filename, 'private');
                $hc->{$storageName} = $path;
            }
        }

        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'public' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-hc', $filename, 'public');
                $hc->{$field} = $path;
            }
        }
        $hc->save($validasidata);

        return redirect('/admin/hak-cipta')->with('success', 'Data hak cipta berhasil ditambahkan');
    }
    public function storeTambahHcUmum(Request $request)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'user_id' => 'required|exists:users,id', 
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tanggal_lahir' => 'required',
            'ktp_inventor' => 'required|mimes:pdf',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required',
            'institusi' => 'required',
            'jenis_ciptaan' => 'required',
            'judul_ciptaan' => 'required',
            'uraian_singkat' => 'required|max:60000',
            'dokumen_invensi' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'surat_pernyataan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'

        ]);

        $hc = new HakCipta();
        $hc->user_id = $request->user_id;
        $hc->nama_lengkap = $request->nama_lengkap;
        $hc->alamat = $request->alamat;
        $hc->no_telepon = $request->no_telepon;
        $hc->tanggal_lahir = $request->tanggal_lahir;
        $hc->email = $request->email;
        $hc->kewarganegaraan = $request->kewarganegaraan;
        $hc->kode_pos = $request->kode_pos;
        $hc->institusi = $request->institusi;
        $hc->jenis_ciptaan = $request->jenis_ciptaan;
        $hc->judul_ciptaan = $request->judul_ciptaan;
        $hc->uraian_singkat = $request->uraian_singkat;
        $hc->tanggal_permohonan = $request->tanggal_permohonan;

        $publicFiles = ['dokumen_invensi'];
        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'data_pengaju2' => 'data_pengaju2',
            'surat_pengalihan' => 'surat_pengalihan',
            'surat_pernyataan' => 'surat_pernyataan'
        ];

        // Proses unggahan file ke private storage
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'private' dalam folder '/dokumen-hc'
                $path = $file->storeAs('dokumen-hc', $filename, 'private');
                $hc->{$storageName} = $path;
            }
        }

        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'public' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-hc', $filename, 'public');
                $hc->{$field} = $path;
            }
        }
        $hc->save($validasidata);
        return redirect('/admin/hak-cipta')->with('success', 'Data hak cipta berhasil ditambahkan');
    }

    /**
     * Tampilkan form pilih tujuan (Produk Inovasi / Penelitian) + KBK,
     * untuk mengirim data hak cipta yang sudah selesai ke Dashboard.
     */
    public function formKirimKeDashboard(string $id)
    {
        $hakCipta = HakCipta::findOrFail($id);
        $kbk = DB::table('kelompok_keahlians')->get();

        return view('kekayaanintelektual::admin.adminhk.kirim-ke-dashboard', compact('hakCipta', 'kbk'));
    }

    /**
     * Proses pengiriman data hak cipta ke tabel produks/penelitians.
     */
    public function kirimKeDashboard(Request $request, string $id, KirimKeDashboardService $service)
    {
        $request->validate([
            'tujuan' => 'required|in:produk,penelitian',
            'kbk_id' => 'required|exists:kelompok_keahlians,id',
        ]);

        $hakCipta = HakCipta::findOrFail($id);

        if ($hakCipta->dikirim_ke) {
            return back()->with('kirim_error', 'Data ini sudah pernah dikirim ke ' . $hakCipta->dikirim_ke . '.');
        }

        $service->kirim('hak_cipta', $hakCipta, $request->tujuan, (int) $request->kbk_id);

        return redirect()
            ->route('admin_hakcipta.show', $id)
            ->with('kirim_success', 'Data berhasil dikirim ke ' . ucfirst($request->tujuan) . '.');
    }
}