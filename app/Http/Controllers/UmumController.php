<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paten;
use App\Models\HakCipta;
use Illuminate\Http\Request;
use App\Models\DesainIndustri;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class UmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paten = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', auth()->user()->role)->count();

        $hc = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', auth()->user()->role)->count();

        $di = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', auth()->user()->role)->count();
        return view('umum.index', compact('paten', 'hc', 'di'));
    }
    public function paten()
    {
        $paten = Paten::with('cek')->where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', auth()->user()->role)->paginate(5);


        $pf = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Pemeriksaan Formalitas')->count();

        $mt = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Tanggapan Formalitas')->count();

        $mp = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Masa Pengumuman')->count();

        $mps = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Pembayaran Substansif')->count();

        $staw = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Substansif Tahap Awal')->count();

        $stl = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Substansif Tahap Lanjut')->count();

        $stak = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Substansif Tahap Akhir')->count();

        $mts = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Tanggapan Substansif')->count();

        $catat = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Diberi')->count();

        $tolak = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Ditolak')->count();

        $mvdov = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        return view('umum.paten.index', compact('pf', 'paten', 'mt', 'mp', 'mps', 'staw', 'stl', 'stak', 'mts', 'catat', 'tolak', 'mvdov'));
    }
    public function cariPaten(Request $request)
    {
        $cari = $request->input('cari');
        $paten = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where(function ($query) use ($cari) {
            $query->where('judul_paten', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%");
        })->paginate(5);

        $pf = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Pemeriksaan Formalitas')->count();

        $mt = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Tanggapan Formalitas')->count();

        $mp = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Masa Pengumuman')->count();

        $mps = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Pembayaran Substansif')->count();

        $staw = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Substansif Tahap Awal')->count();

        $stl = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Substansif Tahap Lanjut')->count();

        $stak = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Substansif Tahap Akhir')->count();

        $mts = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Tanggapan Substansif')->count();

        $catat = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Diberi')->count();

        $tolak = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Ditolak')->count();

        $mvdov = Paten::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        return view('umum.paten.index', compact('pf', 'mt', 'mp', 'mps', 'staw', 'stl', 'stak', 'mts', 'catat', 'tolak', 'paten', 'mvdov'));
    }
    public function hakCipta()
    {
        $tolak = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Ditolak')->count();

        $tercatat = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Tercatat')->count();

        $null = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Keterangan belum lengkap')->count();

        $hc = HakCipta::with('cekhc')
            ->where(function ($query) {
                $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
            })->where('institusi', auth()->user()->role)->paginate(5);

        $mvdov = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        return view('umum.hakcipta.index', compact('hc', 'tercatat', 'null', 'tolak', 'mvdov'));
    }
    public function cariHc(Request $request)
    {
        $cari = $request->input('cari');
        $hc = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where(function ($query) use ($cari) {
            $query->where('judul_ciptaan', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%");
        })->paginate(5);

        $tolak = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Ditolak')->count();

        $tercatat = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Tercatat')->count();

        $null = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Keterangan belum lengkap')->count();

        $mvdov = HakCipta::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('institusi', Auth::user()->role)->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        return view('umum.hakcipta.index', compact('hc', 'tercatat', 'null', 'tolak', 'mvdov'));
    }
    public function desainIndustri()
    {
        $di = DesainIndustri::with('cekDi')->where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', auth()->user()->role)->paginate(5);

        $desainDi = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Diberi')->count();
        $desainDK = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Ditolak')->count();
        $desainP = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Pemeriksaan Formalitas')->count();
        $desainKBL = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Keterangan Belum Lengkap')->count();
        $desainDPU = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Dalam Proses Usulan')->count();
        $mvdov = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        return view('umum.desainindustri.index', compact('desainDi', 'desainP', 'desainDPU', 'desainKBL', 'desainDK', 'mvdov', 'di'));
    }
    public function cariDi(Request $request)
    {
        $cari = $request->input('cari');
        $di = DesainIndustri::with('cekDi')->where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', auth()->user()->role)->paginate(5);

        $desainDi = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Diberi')->count();
        $desainDK = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Ditolak')->count();
        $desainP = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Pemeriksaan Formalitas')->count();
        $desainKBL = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Keterangan Belum Lengkap')->count();
        $desainDPU = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Dalam Proses Usulan')->count();
        $mvdov = DesainIndustri::where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('nama_lengkap', Auth::user()->nama_lengkap);
        })->where('institusi', Auth::user()->role)->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        return view('umum.desainindustri.index', compact('desainDi', 'desainP', 'desainDPU', 'desainKBL', 'desainDK', 'mvdov', 'di'));
    }
    public function lihatDi(string $id)
    {
        $di = DesainIndustri::with('cekDi')->find($id);
        return view('umum.desainindustri.lihat.index', compact('di'));
    }

    public function viewSensitifFilesDi($filename)
    {
        // Path file yang akan diakses
        $fileDi = storage_path('app/private/dokumen-di/' . $filename);

        // Pastikan file ada
        if (!file_exists($fileDi)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Validasi akses file (hanya pemilik file yang bisa mengaksesnya)
        $di = DesainIndustri::where('ktp_inventor', 'dokumen-di/' . $filename)
            ->orWhere('data_pengaju2', 'dokumen-di/' . $filename)
            ->orWhere('surat_kepemilikan', 'dokumen-di/' . $filename)
            ->orWhere('surat_pengalihan', 'dokumen-di/' . $filename)
            ->first();

        // Pastikan file milik user yang sedang login
        if (!$di || $di->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Mengirim file sebagai response
        return response()->file($fileDi);
    }

    public function editDi(string $id)
    {
        $di = DesainIndustri::find($id);
        return view('umum.desainindustri.edit.index', compact('di'));
    }
    public function hapusDi(string $id)
    {
        DesainIndustri::findOrFail($id)->delete();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pengajuanPaten()
    {
        return view('umum.paten.pengajuan.index');
    }
    public function lihatPaten(string $id)
    {
        $paten = Paten::with('cek')->find($id);
        return view('umum.paten.lihat.index', compact('paten'));
    }

    public function viewSensitifFilesPaten($filename)
    {
        // Path file yang akan diakses
        $filePaten = storage_path('app/private/dokumen-paten/' . $filename);
        // Pastikan file ada
        if (!file_exists($filePaten)) {
            abort(404, 'File tidak ditemukan.');
        }
        // Validasi akses file (hanya pemilik file yang bisa mengaksesnya)
        $paten = Paten::where(function ($query) use ($filename) {
            $query->where('ktp_inventor', 'dokumen-paten/' . $filename)
                ->orWhere('pengalihan_hak', 'dokumen-paten/' . $filename)
                ->orWhere('klaim', 'dokumen-paten/' . $filename)
                ->orWhere('pernyataan_kepemilikan', 'dokumen-paten/' . $filename)
                ->orWhere('surat_kuasa', 'dokumen-paten/' . $filename);
        })->first();
        // Pastikan file milik user yang sedang login
        if (!$paten || $paten->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Mengirim file sebagai response
        return response()->file($filePaten);
        
    }
    public function viewPublicFilesPaten($filename)
    {
        // Path file yang akan diakses
        $filePaten = storage_path('app/public/dokumen-paten/' . $filename);
        // Pastikan file ada
        if (!file_exists($filePaten)) {
            abort(404, 'File tidak ditemukan.');
        }
        // Validasi akses file (hanya pemilik file yang bisa mengaksesnya)
        $paten = Paten::where(function ($query) use ($filename) {
            $query
                ->Where('abstrak_paten','dokumen-paten/' . $filename)
                ->orWhere('deskripsi_paten','dokumen-paten/' . $filename)
                ->orWhere('gambar_paten','dokumen-paten/' . $filename)
                ->orWhere('gambar_tampilan','dokumen-paten/' . $filename)
                ->orWhere('sertifikat_paten','dokumen-paten/' . $filename);

        })->first();
        // Pastikan file milik user yang sedang login
        if (!$paten || $paten->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Mengirim file sebagai response
        return response()->file($filePaten);
        
    }

    public function editPaten(string $id)
    {
        $p = Paten::find($id);
        return view('umum.paten.edit.index', compact('p'));
    }
    public function hapusPaten(string $id)
    {
        Paten::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function updatePaten(Request $request, string $id)
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

        try {
            // Cari data paten berdasarkan ID
            $paten = new Paten();
            $paten->user_id = Auth::user()->id;
            $paten->nama_lengkap = $request->nama_lengkap;
            $paten->alamat = $request->alamat;
            $paten->no_telepon = $request->no_telepon;
            $paten->tanggal_lahir = $request->tanggal_lahir;
            $paten->email = $request->email;
            $paten->kewarganegaraan = $request->kewarganegaraan;
            $paten->kode_pos = $request->kode_pos;
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

            // Redirect dengan pesan sukses
            return redirect('/umum/paten')->with('success', 'Data Paten berhasil diperbarui!');
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan error
            Log::error('Error saat mengupdate paten: ' . $e->getMessage());
            return redirect('/umum/pengajuan/paten')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pengajuanHc()
    {
        return view('umum.hakcipta.pengajuan.index');
    }
    public function pengajuanDi()
    {
        return view('umum.desainindustri.pengajuan.index');
    }
    public function lihatHc(string $id)
    {
        $hc = HakCipta::with('cekhc')->find($id);

        return view('umum.hakcipta.lihat.index', compact('hc'));
    }

    public function viewSensitifFilesHc($filename)
    {
        // Tentukan path file (pastikan sesuai struktur penyimpanan)
        $filePath = storage_path('app/private/dokumen-hc/' . $filename);

        // Cek keberadaan file
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Validasi apakah file dimiliki oleh user yang sedang login
        $hc = HakCipta::where('ktp_inventor', 'dokumen-hc/' . $filename)
            ->orWhere('surat_pengalihan', 'dokumen-hc/' . $filename)
            ->orWhere('surat_pernyataan', 'dokumen-hc/' . $filename)
            ->first();

        if (!$hc || $hc->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // Kembalikan file sebagai response
        return response()->file($filePath);
    }

    public function hapusHc(string $id)
    {
        HakCipta::findOrFail($id)->delete();
        return redirect()->back();
    }
    public function editHc(string $id)
    {
        $hc = HakCipta::find($id);
        return view('umum.hakcipta.edit.index', compact('hc'));
    }

    public function updateDi(Request $request, string $id)
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
            'jenis_di' => 'required',
            'judul_di' => 'required',
            'uraian_di' => 'nullable|mimes:pdf|max:2028',
            'gambar_di' => 'nullable|mimes:pdf|max:2028',
            'surat_kepemilikan' => 'nullable|mimes:pdf|max:2028',
            'surat_pengalihan' => 'nullable|mimes:pdf|max:2028',
            'tanggal_permohonan' => 'required|date'
        ]);

        try {
            $di = DesainIndustri::findOrFail($id);
            $di->user_id = Auth::user()->id;
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

            $privateFiles = [
                'ktp_inventor'      => 'ktp_inventor',
                'surat_kepemilikan' => 'surat_kepemilikan',
                'surat_pengalihan'  => 'surat_pengalihan',
            ];
            foreach ($privateFiles as $field => $storageName) {
                if ($request->hasFile($field)) {
                    if ($di->{$storageName}) {
                        Storage::disk('private')->delete($di->{$storageName});
                    }
                    $filename = time() . '_' . str_replace(' ', '_', $request->file($field)->getClientOriginalName());
                    $di->{$storageName} = $request->file($field)->storeAs('dokumen-di', $filename, 'private');
                }
            }

            $publicFiles = ['uraian_di', 'gambar_di'];
            foreach ($publicFiles as $field) {
                if ($request->hasFile($field)) {
                    if ($di->{$field}) {
                        Storage::disk('public')->delete($di->{$field});
                    }
                    $filename = time() . '_' . str_replace(' ', '_', $request->file($field)->getClientOriginalName());
                    $di->{$field} = $request->file($field)->storeAs('dokumen-di', $filename, 'public');
                }
            }

            $di->save($validasidata);
            return redirect('/umum/desain-industri')->with('success', 'Data Desain Industri berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate Desain Industri: ' . $e->getMessage());
            return redirect('/umum/desain-industri')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function updateHc(Request $request, string $id)
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

        try {
            $hc = HakCipta::findOrFail($id);

            $hc->user_id = Auth::user()->id;
            $hc->nama_lengkap = $request->nama_lengkap;
            $hc->alamat = $request->alamat;
            $hc->no_telepon = $request->no_telepon;
            $hc->tanggal_lahir = $request->tanggal_lahir;
            $hc->institusi = $request->institusi;
            $hc->email = $request->email;
            $hc->kewarganegaraan = $request->kewarganegaraan;
            $hc->kode_pos = $request->kode_pos;
            $hc->jenis_ciptaan = $request->jenis_ciptaan;
            $hc->judul_ciptaan = $request->judul_ciptaan;
            $hc->uraian_singkat = $request->uraian_singkat;
            $hc->tanggal_permohonan = $request->tanggal_permohonan;

            $privateFiles = [
                'ktp_inventor'    => 'ktp_inventor',
                'surat_pengalihan' => 'surat_pengalihan',
                'surat_pernyataan' => 'surat_pernyataan',
            ];
            foreach ($privateFiles as $field => $storageName) {
                if ($request->hasFile($field)) {
                    if ($hc->{$storageName}) {
                        Storage::disk('private')->delete($hc->{$storageName});
                    }
                    $filename = time() . '_' . str_replace(' ', '_', $request->file($field)->getClientOriginalName());
                    $hc->{$storageName} = $request->file($field)->storeAs('dokumen-hc', $filename, 'private');
                }
            }

            // dokumen_invensi disimpan di disk public
            if ($request->hasFile('dokumen_invensi')) {
                if ($hc->dokumen_invensi) {
                    Storage::disk('public')->delete($hc->dokumen_invensi);
                }
                $filename = time() . '_' . str_replace(' ', '_', $request->file('dokumen_invensi')->getClientOriginalName());
                $hc->dokumen_invensi = $request->file('dokumen_invensi')->storeAs('dokumen-hc', $filename, 'public');
            }

            $hc->save($validasidata);

            return redirect('/umum/hak-cipta')->with('success', 'Data Hak Cipta berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate Hak Cipta: ' . $e->getMessage());
            return redirect('/umum/hak-cipta')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function simpanPaten(Request $request)
    {
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

        try {
            $paten = new Paten();
            $paten->user_id = Auth::user()->id;
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
            // Simpan data ke database
            $paten->save($validasidata);

            // Redirect ke halaman sukses
            return redirect('/umum/pengajuan/paten')->with('success', 'Data Paten berhasil Disimpan!');
        } catch (\Exception $e) {
            // Tangani error
            Log::error('Error saat menyimpan paten: ' . $e->getMessage());
            return redirect('/umum/pengajuan/paten')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function simpanHc(Request $request)
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

        try {
            $hc = new HakCipta();
            $hc->user_id = Auth::user()->id;
            $hc->nama_lengkap = $request->nama_lengkap;
            $hc->alamat = $request->alamat;
            $hc->no_telepon = $request->no_telepon;
            $hc->tanggal_lahir = $request->tanggal_lahir;
            $hc->institusi = $request->institusi;
            $hc->email = $request->email;
            $hc->kewarganegaraan = $request->kewarganegaraan;
            $hc->kode_pos = $request->kode_pos;
            $hc->jenis_ciptaan = $request->jenis_ciptaan;
            $hc->judul_ciptaan = $request->judul_ciptaan;
            $hc->uraian_singkat = $request->uraian_singkat;
            $hc->tanggal_permohonan = $request->tanggal_permohonan;
            // Proses upload file

            $privateFiles = [
                'ktp_inventor'    => 'ktp_inventor',
                'surat_pengalihan' => 'surat_pengalihan',
                'surat_pernyataan' => 'surat_pernyataan',
            ];
            foreach ($privateFiles as $field => $storageName) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $hc->{$storageName} = $file->storeAs('dokumen-hc', $filename, 'private');
                }
            }

            // dokumen_invensi disimpan di disk public
            if ($request->hasFile('dokumen_invensi')) {
                $file = $request->file('dokumen_invensi');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $hc->dokumen_invensi = $file->storeAs('dokumen-hc', $filename, 'public');
            }

            // Simpan data ke database
            $hc->save($validasidata);

            // Redirect ke halaman sukses
            return redirect('/umum/hak-cipta/pengajuan')->with('success', 'Data hak cipta berhasil Disimpan!');
        } catch (\Exception $e) {
            // Tangani error
            Log::error('Error saat menyimpan hak cipta: ' . $e->getMessage());
            return redirect('/umum/hak-cipta/pengajuan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }





    public function simpanDi(Request $request)
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

        try {
            $di = new DesainIndustri();
            $di->user_id = Auth::user()->id;
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

            $privateFiles = [
                'ktp_inventor'      => 'ktp_inventor',
                'data_pengaju2'     => 'data_pengaju2',
                'surat_kepemilikan' => 'surat_kepemilikan',
                'surat_pengalihan'  => 'surat_pengalihan',
            ];
            foreach ($privateFiles as $field => $storageName) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $di->{$storageName} = $file->storeAs('dokumen-di', $filename, 'private');
                }
            }

            // uraian_di & gambar_di disimpan di disk public
            $publicFiles = ['uraian_di', 'gambar_di'];
            foreach ($publicFiles as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $di->{$field} = $file->storeAs('dokumen-di', $filename, 'public');
                }
            }

            // Simpan data ke database
            $di->save($validasidata);

            // Redirect ke halaman sukses
            return redirect('/umum/desain-industri/pengajuan')->with('success', 'Data desain industri berhasil Disimpan!');
        } catch (\Exception $e) {
            // Tangani error
            Log::error('Error saat menyimpan desain industri: ' . $e->getMessage());
            return redirect('/umum/desain-industri/pengajuan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function lihatProfil()
    {
        return view('umum.profil.index');
    }
    public function editProfil(string $id)
    {
        $user = User::find($id);
        // dd($user->ktp);

        return view('umum.profil.edit.index', compact('user'));
    }
    public function updateProfil(Request $request, string $id)
    {
        $validasidata = $request->validate([
            'email' => 'required|email',
            'username' => 'required|min:3',
        ]);
        $user = User::find($id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->kerjaan = $request->kerjaan;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save($validasidata);
        return redirect('/umum/user/lihat')->with('success', 'Data berhasil Diupdate!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
