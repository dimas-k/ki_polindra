<?php

namespace App\Http\Controllers;

use App\Models\Paten;
use App\Models\HakCipta;
use Illuminate\Http\Request;
use App\Models\DesainIndustri;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paten1 = Paten::latest()->paginate(5);
        $carijudul = $request->get('cari_judul');
        $carinama = $request->get('cari_nama');

        $hitung = Paten::all()->count();

        $pf = Paten::where('status', 'Pemeriksaan Formalitas')->count();
        $mt = Paten::where('status', 'Menunggu Tanggapan Formalitas')->count();
        $mp = Paten::where('status', 'Masa pengumuman')->count();
        $mps = Paten::where('status', 'Menunggu Pembayaran Substansif')->count();
        $staw = Paten::where('status', 'Substansif Tahap Awal')->count();
        $stl = Paten::where('status', 'Substansif Tahap Lanjut')->count();
        $stak = Paten::where('status', 'Substansif Tahap Akhir')->count();
        $mts = Paten::where('status', 'Menunggu Tanggapan Substansif')->count();
        $catat = Paten::where('status', 'Diberi')->count();
        $tolak = Paten::where('status', 'Ditolak')->count();
        $mvdov = Paten::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        $paten = Paten::where('institusi')->count();
        $patenPF = Paten::where('status', 'Pemeriksaan formalitas')->count();
        $patenMTF = Paten::where('status', 'Menunggu tanggapan formalitas')->count();
        $patenMP = Paten::where('status', 'Masa pengumuman')->count();
        $patenMPS = Paten::where('status', 'Menunggu pembayaran substansif')->count();
        $patenSTAW = Paten::where('status', 'Substansif tahap awal')->count();
        $patenSTL = Paten::where('status', 'Substansif tahap lanjut')->count();
        $patenSTAK = Paten::where('status', 'Substansif tahap akhir')->count();
        $patenMTS = Paten::where('status', 'Menunggu tanggapan substansif')->count();
        $patenDI = Paten::where('status', 'Diberi')->count();
        $patenDK = Paten::where('status', 'Ditolak')->count();

        $data = Paten::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
            ->groupByRaw('YEAR(tanggal_permohonan)')
            ->orderByRaw('YEAR(tanggal_permohonan) ASC')
            ->get();


        $allYears = range($data->min('tahun'), $data->max('tahun'));

        $formattedData = collect($allYears)->map(function ($year) use ($data) {
            return [
                'tahun' => $year,
                'jumlah' => $data->firstWhere('tahun', $year)->jumlah ?? 0
            ];
        });

        $tahun = $formattedData->pluck('tahun')->toArray();
        $jumlah = $formattedData->pluck('jumlah')->toArray();

        return view('umum-page.paten.index', compact('pf', 'paten1', 'paten', 'mt', 'mp', 'mps', 'staw', 'stl', 'stak', 'mts', 'catat', 'tolak', 'hitung', 'patenPF', 'patenMTF', 'patenMP', 'patenMPS', 'patenSTAW', 'patenSTL', 'patenSTL', 'patenSTAK', 'patenMTS', 'patenDI', 'patenDK', 'tahun', 'jumlah', 'mvdov'));
    }

    public function cari(Request $request)
    {
        $carijudul = $request->input('cari_judul');
        $carinama = $request->input('cari_nama');
        $paten1 = Paten::when($carijudul, function ($query, $carijudul) {
            return $query->where('judul_paten', 'LIKE', "%" . $carijudul . "%");
        })
            ->when($carinama, function ($query, $carinama) {
                return $query->orWhere('nama_lengkap', 'LIKE', "%" . $carinama . "%");
            })
            ->paginate(5);
        // $paten = DB::table('paten')->whereRaw('judul_paten','LIKE',"%".$carijudul."%")->orWhere('nama_lengkap','LIKE',"%".$carinama."%")->paginate(5); //penggunaan raw queri

        $hitung = Paten::all()->count();
        $pf = Paten::where('status', 'Pemeriksaan Formalitas')->count();
        $mt = Paten::where('status', 'Menunggu Tanggapan Formalitas')->count();
        $mp = Paten::where('status', 'Masa pengumuman')->count();
        $mps = Paten::where('status', 'Menunggu Pembayaran Substansif')->count();
        $staw = Paten::where('status', 'Substansif Tahap Awal')->count();
        $stl = Paten::where('status', 'Substansif Tahap Lanjut')->count();
        $stak = Paten::where('status', 'Substansif Tahap Akhir')->count();
        $mts = Paten::where('status', 'Menunggu Tanggapan Substansif')->count();
        $catat = Paten::where('status', 'Diberi')->count();
        $tolak = Paten::where('status', 'Ditolak')->count();
        $mvdov = Paten::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        $paten = Paten::where('institusi')->count();
        $patenPF = Paten::where('status', 'Pemeriksaan formalitas')->count();
        $patenMTF = Paten::where('status', 'Menunggu tanggapan formalitas')->count();
        $patenMP = Paten::where('status', 'Masa pengumuman')->count();
        $patenMPS = Paten::where('status', 'Menunggu pembayaran substansif')->count();
        $patenSTAW = Paten::where('status', 'Substansif tahap awal')->count();
        $patenSTL = Paten::where('status', 'Substansif tahap lanjut')->count();
        $patenSTAK = Paten::where('status', 'Substansif tahap akhir')->count();
        $patenMTS = Paten::where('status', 'Menunggu tanggapan substansif')->count();
        $patenDI = Paten::where('status', 'Diberi')->count();
        $patenDK = Paten::where('status', 'Ditolak')->count();

        $data = Paten::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
            ->groupByRaw('YEAR(tanggal_permohonan)')
            ->orderByRaw('YEAR(tanggal_permohonan) ASC')
            ->get();


        $allYears = range($data->min('tahun'), $data->max('tahun'));

        $formattedData = collect($allYears)->map(function ($year) use ($data) {
            return [
                'tahun' => $year,
                'jumlah' => $data->firstWhere('tahun', $year)->jumlah ?? 0
            ];
        });

        $tahun = $formattedData->pluck('tahun')->toArray();
        $jumlah = $formattedData->pluck('jumlah')->toArray();

        return view('umum-page.paten.index', compact('pf', 'paten1', 'paten', 'mt', 'mp', 'mps', 'staw', 'stl', 'stak', 'mts', 'catat', 'tolak', 'hitung', 'patenPF', 'patenMTF', 'patenMP', 'patenMPS', 'patenSTAW', 'patenSTL', 'patenSTL', 'patenSTAK', 'patenMTS', 'patenDI', 'patenDK', 'tahun', 'jumlah', 'mvdov'));
    }
    public function orang()
    {
        $orang = Paten::orderBy('nama_lengkap', 'asc')->get();

        return view('umum-page.paten.perorangan.index', compact('orang'));
    }
    public function cariOrang(Request $request)
    {
        $cario = $request->input('nama');
        $nama = Paten::orderBy('nama_lengkap', 'asc')->paginate(10);
        $orang = Paten::where('nama_lengkap', $cario)->orderBy('nama_lengkap', 'asc')->paginate(15);
        return view('umum-page.paten.perorangan.cari', compact('orang', 'nama'));
    }
    public function jurusan()
    {
        return view('umum-page.paten.jurusan.index');
    }
    public function cariJurusan(Request $request)
    {
        $carij = $request->input('jurusan');
        $jurusan = Paten::where('jurusan', $carij)->paginate(10);
        return view('umum-page.paten.jurusan.cari', compact('jurusan'));
    }
    public function prodi()
    {
        return view('umum-page.paten.prodi.index');
    }
    public function cariProdi(Request $request)
    {
        $cariprodi = $request->input('prodi');
        $prodi = Paten::where('prodi', $cariprodi)->paginate(10);

        return view('umum-page.paten.prodi.cari', compact('prodi'));
    }

    public function pemeriksaanFormalitas()
    {
        $cek = Paten::latest()->where('status', 'Pemeriksaan Formalitas')->get();
        return view('patenpf.index', compact('cek'));
    }

    public function menungguTanggapan()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Tanggapan Formalitas')->get();
        return view('patenmt.index', compact('cek'));
    }

    public function masaPengumuman()
    {
        $cek = Paten::latest()->where('status', 'Masa Pengumuman')->get();
        return view('paten-mp.index', compact('cek'));
    }

    public function pembayaranSubstansif()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Pembayaran Substansif')->get();
        return view('paten-mps.index', compact('cek'));
    }

    public function substansifAwal()
    {
        $cek = Paten::latest()->where('status', 'Substansif Tahap Awal')->get();
        return view('paten-staw.index', compact('cek'));
    }

    public function substansifLanjut()
    {
        $cek = Paten::latest()->where('status', 'Substansif Tahap Lanjut')->get();
        return view('paten-stl.index', compact('cek'));
    }
    public function substansifAkhir()
    {
        $cek = Paten::latest()->where('status', 'Substansif Tahap Akhir')->get();
        return view('paten-stak.index', compact('cek'));
    }
    public function mvdov()
    {
        $mvdov = Paten::latest()->where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->get();
        return view('umum-page.paten.paten-mvdov.index', compact('mvdov'));
    }
    public function mengungguTanggapanSubstansif()
    {
        $cek = Paten::latest()->where('status', 'Menunggu Tanggapan Substansif')->get();
        return view('paten-mts.index', compact('cek'));
    }
    public function diberi()
    {
        $cek = Paten::latest()->where('status', 'Diberi')->get();
        return view('paten-beri.index', compact('cek'));
    }
    public function ditolak()
    {
        $cek = Paten::latest()->where('status', 'Ditolak')->get();
        return view('paten-tlk.index', compact('cek'));
    }
    public function showPengajuan()
    {
        return view('p-paten.index');
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
        $validasidata = $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tanggal_lahir' => 'required',
            'ktp_inventor' => 'required|mimes:pdf',
            'email' => 'required|email.dns',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required|integer',
            'jenis_paten' => 'required',
            'judul_paten' => 'required',
            'deskripsi_paten' => 'required|mimes:pdf|max:2028',
            'abstrak_paten' => 'required|mimes:pdf|max:2028',
            'pengalihan_hak' => 'required|mimes:pdf|max:2028',
            'klaim' => 'required|mimes:pdf',
            'pernyataan_kepemilikan' => 'required|mimes:pdf',
            'surat_kuasa' => 'required|mimes:pdf',
            'gambar_paten' => 'required|mimes:pdf',
            'gambar_tampilan' => 'required|mimes:pdf',
        ]);
        $paten = new Paten();
        $paten->nama_lengkap = $request->nama_lengkap;
        $paten->alamat = $request->alamat;
        $paten->no_telepon = $request->no_telepon;
        $paten->tanggal_lahir = $request->tanggal_lahir;
        // File sensitif (data pribadi) disimpan di disk private
        $privateFiles = [
            'ktp_inventor'           => 'ktp_inventor',
            'pengalihan_hak'         => 'pengalihan_hak',
            'klaim'                  => 'klaim',
            'pernyataan_kepemilikan' => 'pernyataan_kepemilikan',
            'surat_kuasa'            => 'surat_kuasa',
        ];
        foreach ($privateFiles as $field => $storageName) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $paten->{$storageName} = $file->storeAs('dokumen-paten', $filename, 'private');
            }
        }

        // File dokumen invensi disimpan di disk public
        $publicFiles = ['abstrak_paten', 'deskripsi_paten', 'gambar_paten', 'gambar_tampilan'];
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $paten->{$field} = $file->storeAs('dokumen-paten', $filename, 'public');
            }
        }

        $paten->email = $request->email;
        $paten->kewarganegaraan = $request->kewarganegaraan;
        $paten->kode_pos = $request->kode_pos;
        $paten->jenis_paten = $request->jenis_paten;
        $paten->judul_paten = $request->judul_paten;
        $paten->tanggal_permohonan = $request->tanggal_permohonan;

        $paten->save($validasidata);

        return redirect('/pengajuan-paten')->with('success', 'Data Paten berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paten = Paten::find($id);
        return view('patenshow.index', compact('paten'));
    }
    public function viewPublicFilesPatenGuest($filename)
    {
        $filePaten = storage_path('app/public/dokumen-paten/' . $filename);

        if (!file_exists($filePaten)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Pastikan file termasuk kolom publik yang diizinkan
        $paten = Paten::where(function ($query) use ($filename) {
            $query->Where('abstrak_paten', 'dokumen-paten/' . $filename)
                ->orWhere('deskripsi_paten', 'dokumen-paten/' . $filename)
                ->orWhere('gambar_paten', 'dokumen-paten/' . $filename)
                ->orWhere('gambar_tampilan', 'dokumen-paten/' . $filename)
                ->orWhere('sertifikat_paten', 'dokumen-paten/' . $filename);
        })->first();

        if (!$paten) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($filePaten);
    }

    public function viewPublicFilesHcGuest($filename)
    {
        $fileHc = storage_path('app/public/dokumen-hc/' . $filename);

        if (!file_exists($fileHc)) {
            abort(404, 'File tidak ditemukan.');
        }

        $hc = HakCipta::where(function ($query) use ($filename) {
            $query->where('dokumen_invensi', 'dokumen-hc/' . $filename)
                ->orWhere('sertifikat_hakcipta', 'dokumen-hc/' . $filename);
        })->first();

        if (!$hc) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($fileHc);
    }

    public function viewPublicFilesDiGuest($filename)
    {
        $fileDi = storage_path('app/public/dokumen-di/' . $filename);

        if (!file_exists($fileDi)) {
            abort(404, 'File tidak ditemukan.');
        }

        $di = DesainIndustri::where(function ($query) use ($filename) {
            $query->where('uraian_di', 'dokumen-di/' . $filename)
                ->orWhere('gambar_di', 'dokumen-di/' . $filename)
                ->orWhere('sertifikat_desain', 'dokumen-di/' . $filename);
        })->first();

        if (!$di) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($fileDi);
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
