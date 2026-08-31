<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesainIndustri;
use App\Models\Prodi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDesainIndustriController extends Controller
{
    public function index()
    {   
        $desain = DesainIndustri::with('cekDi')->latest()->paginate(5);
        $beri = DesainIndustri::where('status','Diberi')->count();
        $proses = DesainIndustri::where('status','Dalam Proses Usulan')->count();
        $priksa = DesainIndustri::where('status','Pemeriksaan')->count();
        $null = DesainIndustri::where('status','Keterangan Belum Lengkap')->count();
        $mvdov = DesainIndustri::where('status','Menunggu Verifikasi Data Oleh Verifikator')->count();
        $tolak = DesainIndustri::where('status','Ditolak')->count();
        return view('kekayaanintelektual::admin.admindi.index', compact('desain', 'priksa', 'proses', 'null','tolak','beri','mvdov')); 
    }
    public function cariDi(Request $request)
    {
        $cari = $cari = $request->input('cari');
        $desain = DesainIndustri::with('cekDi')->where('judul_di', 'LIKE', "%" . $cari . "%")->orWhere('nama_lengkap', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%")->orWhere('institusi', 'LIKE', "%" . $cari . "%")->paginate(5);
        $beri = DesainIndustri::where('status','Diberi')->count();
        $proses = DesainIndustri::where('status','Dalam Proses Usulan')->count();
        $priksa = DesainIndustri::where('status','Pemeriksaan')->count();
        $null = DesainIndustri::where('status','Keterangan Belum Lengkap')->count();
        $tolak = DesainIndustri::where('status','Ditolak')->count();
        return view('kekayaanintelektual::admin.admindi.index', compact('desain', 'priksa', 'proses', 'null','tolak','beri')); 
    }

    public function diberi()
    {
        $cek = DesainIndustri::latest()->where('status','Diberi')->paginate(5);
        return view('kekayaanintelektual::admin.admindi.admin-di-beri.index', compact('cek')); 
    }
    public function proses()
    {
        $cek = DesainIndustri::latest()->where('status','Dalam Proses Usulan')->paginate(5);
        return view('kekayaanintelektual::admin.admindi.admin-di-proses.index', compact('cek'));
    }
    public function pemeriksaan()
    {
        $cek = DesainIndustri::latest()->where('status','Pemeriksaan')->paginate(5);
        return view('kekayaanintelektual::admin.admindi.admin-di-priksa.index', compact('cek'));
    }
    public function ditolak()
    {
        $cek = DesainIndustri::latest()->where('status','Ditolak')->paginate(5);
        return view('kekayaanintelektual::admin.admindi.admin-di-tolak.index', compact('cek'));
    }
    public function keteranganBelumLengkap()
    {
        $cek = DesainIndustri::latest()->where('status','Keterangan Belum Lengkap')->paginate(5);
        return view('kekayaanintelektual::admin.admindi.admin-di-null.index', compact('cek'));
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
        $di = DesainIndustri::with('cekDi')->find($id);
        return view('kekayaanintelektual::admin.admindi.showdi.index', compact('di'));
    }

    public function viewPublicFilesDi($filename)
    {
        // Path file di disk 'private'
        $fileDi = storage_path('app/public/dokumen-di/' . $filename);

        // Pastikan file ada
        if (!file_exists($fileDi)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Cari data paten berdasarkan salah satu kolom file
        $di = DesainIndustri::where(function ($query) use ($filename) {
            $query
            ->Where('uraian_di', 'dokumen-di/' . $filename)
            ->orWhere('gambar_di', 'dokumen-di/' . $filename);
        })->first();

        // Validasi akses: hanya pemilik atau admin/verifikator yang bisa melihat
        if (!$di || ($di->user_id !== auth()->id() && auth()->user()->role !== 'Admin')) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Kirim file sebagai respons
        return response()->file($fileDi);
    }
    public function viewSensitifFilesDi($filename)
    {
        // Path file di disk 'private'
        $fileDi = storage_path('app/private/dokumen-di/' . $filename);

        // Pastikan file ada
        if (!file_exists($fileDi)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Cari data paten berdasarkan salah satu kolom file
        $di = DesainIndustri::where(function ($query) use ($filename) {
            $query->where('ktp_inventor', 'dokumen-di/' . $filename)
            ->orWhere('data_pengaju2', 'dokumen-di/' . $filename)
            ->orWhere('surat_kepemilikan', 'dokumen-di/' . $filename)
            ->orWhere('surat_pengalihan', 'dokumen-di/' . $filename);
        })->first();

        // Validasi akses: hanya pemilik atau admin/verifikator yang bisa melihat
        if (!$di || ($di->user_id !== auth()->id() && auth()->user()->role !== 'Admin')) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Kirim file sebagai respons
        return response()->file($fileDi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $di = DesainIndustri::find($id);
        if($di->institusi === 'Dosen'){
            return view('kekayaanintelektual::admin.admindi.editdi.dosen', compact('di'));
        }else if($di->institusi === 'Umum'){
            return view('kekayaanintelektual::admin.admindi.editdi.umum', compact('di'));
        }
    }
    public function updateDiDosen(Request $request, string $id)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tanggal_lahir' => 'required',
            'ktp_inventor' => 'nullable|mimes:pdf',
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required',
            'institusi' => 'required',
            'data_pengaju2' => 'mimes:xlsx',
            'jurusan' => 'required|exists:jurusan,nama_jurusan',
            'prodi' => 'required|exists:prodi,nama_prodi',
            'jenis_di' => 'required',
            'judul_di' => 'required',
            'uraian_di' => 'nullable|mimes:pdf',
            'gambar_di' => 'nullable|mimes:pdf',
            'surat_kepemilikan' => 'nullable|mimes:pdf',
            'surat_pengalihan' => 'nullable|mimes:pdf',
            'tanggal_permohonan' => 'required'
        ]);
        $di = DesainIndustri::find($id);
        $di->nama_lengkap = $request->nama_lengkap;
        $di->alamat = $request->alamat;
        $di->no_telepon = $request->no_telepon;
        $di->tanggal_lahir = $request->tanggal_lahir;
        $di->email = $request->email;
        $di->kewarganegaraan = $request->kewarganegaraan;
        $di->kode_pos = $request->kode_pos;
        $di->institusi = $request->institusi;
        $di->jurusan = $request->jurusan;
        $di->prodi = $request->prodi;
        $di->prodi_id = Prodi::findIdByName($request->prodi);
        $di->jenis_di = $request->jenis_di;
        $di->judul_di = $request->judul_di;
        $di->tanggal_permohonan = $request->tanggal_permohonan;

        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'data_pengaju2' => 'data_pengaju2',
            'surat_kepemilikan' => 'surat_kepemilikan',
            'surat_pengalihan' => 'surat_pengalihan'
        ];

        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                // Jika ada file lama, hapus dari disk 'private'
                if ($di->{$storageName}) {
                    Storage::disk('private')->delete($di->{$storageName});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-di' pada disk 'private'
                $path = $file->storeAs('dokumen-di', $filename, 'private');
                $di->{$storageName} = $path;
            }
        }

        $publicFiles = ['uraian_di', 'gambar_di'];
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                if ($di->{$field}) {
                    Storage::disk('public')->delete($di->{$field});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-di' pada disk 'public'
                $path = $file->storeAs('dokumen-di', $filename, 'public');
                $di->{$field} = $path;
            }
        }

        $di->save($validasidata);
        return redirect('/admin/desain-industri')->with('success', 'Data desain industri berhasil di update');
    }
    public function upateDiUmum(Request $request, string $id)
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
            'jenis_di' => 'required',
            'judul_di' => 'required',
            'uraian_di' => 'required|mimes:pdf',
            'gambar_di' => 'required|mimes:pdf',
            'surat_kepemilikan' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'
        ]);
        $di = DesainIndustri::find($id);
        $di->user_id = Auth::user()->id;
        $di->nama_lengkap = $request->nama_lengkap;
        $di->alamat = $request->alamat;
        $di->no_telepon = $request->no_telepon;
        $di->email = $request->email;
        $di->tanggal_lahir = $request->tanggal_lahir;
        $di->kewarganegaraan = $request->kewarganegaraan;
        $di->kode_pos = $request->kode_pos;
        $di->institusi = $request->institusi;
        $di->jenis_di = $request->jenis_di;
        $di->judul_di = $request->judul_di;
        $di->tanggal_permohonan = $request->tanggal_permohonan;

        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'surat_kepemilikan' => 'surat_kepemilikan',
            'surat_pengalihan' => 'surat_pengalihan'
        ];

        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                // Jika ada file lama, hapus dari disk 'private'
                if ($di->{$storageName}) {
                    Storage::disk('private')->delete($di->{$storageName});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-di' pada disk 'private'
                $path = $file->storeAs('dokumen-di', $filename, 'private');
                $di->{$storageName} = $path;
            }
        }

        $publicFiles = ['uraian_di', 'gambar_di'];
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                if ($di->{$field}) {
                    Storage::disk('public')->delete($di->{$field});
                }
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan file ke folder 'dokumen-di' pada disk 'public'
                $path = $file->storeAs('dokumen-di', $filename, 'public');
                $di->{$field} = $path;
            }
        }

        $di->save($validasidata);
        return redirect('/admin/desain-industri')->with('success', 'Data desain industri berhasil di update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasidata = $request->validate([
            
            'status'=>'required',
            'sertifikat_desain'=>'mimes:pdf',

        ]);

        $di = DesainIndustri::find($id);
        $di->status = $request->status;
        if ($request->file('sertifikat_desain') == null) {
            $di->sertifikat_desain = "";
        }else{
           if ($request->hasFile('sertifikat_desain')) {
                $file = $request->file('sertifikat_desain');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $di->sertifikat_desain = $file->storeAs('dokumen-di', $filename, 'public');
            }
        }
        $di->save($validasidata);
        return redirect('/admin/desain-industri')->with('success', 'Data desain industri berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy2(string $id)
    {
        DesainIndustri::with('cekDi')->findOrFail($id)->delete();
        return redirect()->back()->with('success','Data desain industri berhasil dihapus');
    }
    public function destroy(string $id)
    {
        $di = DesainIndustri::with('cekDi')->findOrFail($id);
        $di->delete();
        return redirect()->back()->with('success', 'Data desain industri dan file-file terkait berhasil dihapus');
    }
    public function tambahDiDosen()
    {
        $users = DB::table('users')
        ->select('id', 'nama_lengkap')
        ->where('role', '=', 'Dosen')
        ->get();
        return view('kekayaanintelektual::admin.admindi.tambah.dosen', compact('users'));
    }
    public function tambahDiUmum()
    {
        $users = DB::table('users')
        ->select('id', 'nama_lengkap')
        ->Where('role','=','Umum')
        ->get();
        return view('kekayaanintelektual::admin.admindi.tambah.umum', compact('users'));
    }

    public function storeDiDosen(Request $request)
    {
        // Validate input data
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
            'jenis_di' => 'required',
            'judul_di' => 'required',
            'uraian_di' => 'required|mimes:pdf',
            'gambar_di' => 'required|mimes:pdf',
            'surat_kepemilikan' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'
        ]);
    
        // Create a new DesainIndustri instance
        $di = new DesainIndustri();
        $di->user_id = $request->user_id;
        $di->nama_lengkap = $request->nama_lengkap;
        $di->alamat = $request->alamat;
        $di->no_telepon = $request->no_telepon;
        $di->tanggal_lahir = $request->tanggal_lahir;
        $di->email = $request->email;
        $di->kewarganegaraan = $request->kewarganegaraan;
        $di->kode_pos = $request->kode_pos;
        $di->institusi = $request->institusi;
        $di->jurusan = $request->jurusan;
        $di->prodi = $request->prodi;
        $di->prodi_id = Prodi::findIdByName($request->prodi);
        $di->jenis_di = $request->jenis_di;
        $di->judul_di = $request->judul_di;
        $di->tanggal_permohonan = $request->tanggal_permohonan;
    
        $publicFiles = ['gambar_di', 'uraian_di'];

        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'data_pengaju2' => 'data_pengaju2',
            'surat_kepemilikan' => 'surat_kepemilikan',
            'surat_pengalihan' => 'surat_pengalihan'
        ];

        // Proses unggahan file ke private storage
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'private' dalam folder '/dokumen-hc'
                $path = $file->storeAs('dokumen-di', $filename, 'private');
                $di->{$storageName} = $path;
            }
        }

        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'public' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-di', $filename, 'public');
                $di->{$field} = $path;
            }
        }
    
        // Save the model
        $di->save($validasidata);
    
        // Redirect with success message
        return redirect('/admin/desain-industri')->with('success', 'Data desain industri berhasil ditambahkan');
    }
    
    public function storeDiUmum(Request $request)
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
            'jenis_di' => 'required',
            'judul_di' => 'required',
            'uraian_di' => 'required|mimes:pdf',
            'gambar_di' => 'required|mimes:pdf',
            'surat_kepemilikan' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'
        ]);
        $di = new DesainIndustri();
        $di->user_id = $request->user_id;
        $di->nama_lengkap = $request->nama_lengkap;
        $di->alamat = $request->alamat;
        $di->no_telepon = $request->no_telepon;
        $di->tanggal_lahir = $request->tanggal_lahir;
        $di->email = $request->email;
        $di->kewarganegaraan = $request->kewarganegaraan;
        $di->kode_pos = $request->kode_pos;
        $di->institusi = $request->institusi;
        $di->jenis_di = $request->jenis_di;
        $di->judul_di = $request->judul_di;
        $di->tanggal_permohonan = $request->tanggal_permohonan;
        $publicFiles = ['gambar_di', 'uraian_di'];

        $privateFiles = [
            'ktp_inventor' => 'ktp_inventor',
            'surat_kepemilikan' => 'surat_kepemilikan',
            'surat_pengalihan' => 'surat_pengalihan'
        ];

        // Proses unggahan file ke private storage
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'private' dalam folder '/dokumen-hc'
                $path = $file->storeAs('dokumen-di', $filename, 'private');
                $di->{$storageName} = $path;
            }
        }

        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                // Simpan di disk 'public' dalam folder 'dokumen-paten'
                $path = $file->storeAs('dokumen-di', $filename, 'public');
                $di->{$field} = $path;
            }
        }
        $di->save($validasidata);

        return redirect('/admin/desain-industri')->with('success', 'Data desain industri berhasil di tambahkan');
    }
}
