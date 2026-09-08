<?php

namespace App\Http\Controllers;

use App\Models\Paten;
use App\Models\HakCipta;
use Illuminate\Http\Request;
use App\Models\DesainIndustri;
use App\Models\Jurusan;
use Illuminate\Routing\Controller;

class DesainIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $di = DesainIndustri::latest()->paginate(5);
        $itung = DesainIndustri::all()->count();
        $beri = DesainIndustri::where('status','Diberi')->count();
        $proses = DesainIndustri::where('status','Dalam Proses Usulan')->count();
        $priksa = DesainIndustri::where('status','Pemeriksaan')->count();
        $null = DesainIndustri::where('status','Keterangan Belum Lengkap')->count();
        $tolak = DesainIndustri::where('status','Ditolak')->count();
        $mvdov = DesainIndustri::where('status','Menunggu Verifikasi Data Oleh Verifikator')->count();

        $desainDi = DesainIndustri::where('status', 'Diberi')->count();
        $desainDK = DesainIndustri::where('status', 'Ditolak')->count();
        $desainP = DesainIndustri::where('status', 'Pemeriksaan')->count();
        $desainKBL = DesainIndustri::where('status', 'Keterangan belum lengkap')->count();
        $desainDPU = DesainIndustri::where('status', 'Dalam proses usulan')->count();

        // Daftar jurusan untuk filter diagram Jumlah Desain Industri per Jurusan.
        // Default (tanpa pilihan) tetap menampilkan data seluruh jurusan seperti semula.
        $jurusanList = Jurusan::orderBy('nama_jurusan')->get();
        $jurusanId = $request->get('jurusan');
        $jurusanTerpilih = $jurusanId ? Jurusan::find($jurusanId) : null;

        $data = DesainIndustri::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
            ->when($jurusanTerpilih, function ($query) use ($jurusanTerpilih) {
                $query->whereRaw('LOWER(TRIM(jurusan)) = ?', [strtolower(trim($jurusanTerpilih->nama_jurusan))]);
            })
            ->groupByRaw('YEAR(tanggal_permohonan)')
            ->orderByRaw('YEAR(tanggal_permohonan) ASC')
            ->get();


        $allYears = $data->isNotEmpty() ? range($data->min('tahun'), $data->max('tahun')) : [];

        $formattedData = collect($allYears)->map(function ($year) use ($data) {
            return [
                'tahun' => $year,
                'jumlah' => $data->firstWhere('tahun', $year)->jumlah ?? 0
            ];
        });

        $tahun = $formattedData->pluck('tahun')->toArray();
        $jumlah = $formattedData->pluck('jumlah')->toArray();

        return view('umum-page.Desainindustri.index', compact('di', 'priksa', 'proses', 'null','tolak','beri','itung','desainDi','desainDK','desainP','desainKBL','desainDPU','tahun','jumlah','mvdov','jurusanList','jurusanTerpilih')); 
    }
    public function cari(Request $request)
    {
        $caridesain = $request->input('cari_di');
        $carinama = $request->input('cari_nama');
        // $di = DesainIndustri::where('judul_di','LIKE',"%".$caridesain."%")->orWhere('nama_lengkap','LIKE',"%".$carinama."%")->paginate(5);
        $di = DesainIndustri::when($caridesain, function ($query, $caridesain) {
            return $query->where('judul_di', 'LIKE', "%" . $caridesain . "%");
        })
        ->when($carinama, function ($query, $carinama) {
            return $query->orWhere('nama_lengkap', 'LIKE', "%" . $carinama . "%");
        })
        ->paginate(5);

        $itung = DesainIndustri::all()->count();
        $beri = DesainIndustri::where('status','Diberi')->count();
        $proses = DesainIndustri::where('status','Dalam Proses Usulan')->count();
        $priksa = DesainIndustri::where('status','Pemeriksaan')->count();
        $null = DesainIndustri::where('status','Keterangan Belum Lengkap')->count();
        $tolak = DesainIndustri::where('status','Ditolak')->count();
        $mvdov = DesainIndustri::where('status','Menunggu Verifikasi Data Oleh Verifikator')->count();

        $desainDi = DesainIndustri::where('status', 'Diberi')->count();
        $desainDK = DesainIndustri::where('status', 'Ditolak')->count();
        $desainP = DesainIndustri::where('status', 'Pemeriksaan')->count();
        $desainKBL = DesainIndustri::where('status', 'Keterangan belum lengkap')->count();
        $desainDPU = DesainIndustri::where('status', 'Dalam proses usulan')->count();

        $paten2020 = Paten::whereYear('tanggal_permohonan','2020')->count();
        $hc2020 = HakCipta::whereYear('tanggal_permohonan','2020')->count();
        $di2020 = DesainIndustri::whereYear('tanggal_permohonan','2020')->count();
        $gabungKi2020 = $paten2020 + $di2020 + $hc2020 ;
        
        $paten2021 = Paten::whereYear('tanggal_permohonan','2021')->count();
        $hc2021 = HakCipta::whereYear('tanggal_permohonan','2021')->count();
        $di2021 = DesainIndustri::whereYear('tanggal_permohonan','2021')->count();
        $gabungKi2021 = $paten2021 + $di2021 + $hc2021 ;

        $paten2022 = Paten::whereYear('tanggal_permohonan','2022')->count();
        $hc2022 = HakCipta::whereYear('tanggal_permohonan','2022')->count();
        $di2022 = DesainIndustri::whereYear('tanggal_permohonan','2022')->count();
        $gabungKi2022 = $paten2022 + $di2022 + $hc2022 ;

        $paten2023 = Paten::whereYear('tanggal_permohonan','2023')->count();
        $hc2023 = HakCipta::whereYear('tanggal_permohonan','2023')->count();
        $di2023 = DesainIndustri::whereYear('tanggal_permohonan','2023')->count();
        $gabungKi2023 = $paten2023 + $di2023 + $hc2023 ;

        $paten2024 = Paten::whereYear('tanggal_permohonan','2024')->count();
        $hc2024 = HakCipta::whereYear('tanggal_permohonan','2024')->count();
        $di2024 = DesainIndustri::whereYear('tanggal_permohonan','2024')->count();
        $gabungKi2024 = $paten2024 + $di2024 + $hc2024 ;

        return view('umum-page.Desainindustri.index', compact('di', 'priksa', 'proses', 'null','tolak','beri','itung','desainDi','desainDK','desainP','desainKBL','desainDPU','di2020','di2021','di2022','di2023','di2024','gabungKi2020','gabungKi2021','gabungKi2022','gabungKi2023','gabungKi2024','mvdov')); 
    }
    
    public function diberi()
    {
        $cek = DesainIndustri::latest()->where('status','Diberi')->get();
        return view('di-beri.index', compact('cek')); 
    }
    public function proses()
    {
        $cek = DesainIndustri::latest()->where('status','Dalam Proses Usulan')->get();
        return view('di-proses.index', compact('cek'));
    }
    public function pemeriksaan()
    {
        $cek = DesainIndustri::latest()->where('status','Pemeriksaan')->get();
        return view('di-priksa.index', compact('cek'));
    }
    public function ditolak()
    {
        $cek = DesainIndustri::latest()->where('status','Ditolak')->get();
        return view('di-tolak.index', compact('cek'));
    }
    public function mvdov()
    {
        $mvdov = DesainIndustri::where('status','Menunggu Verifikasi Data Oleh Verifikator')->get();
        return view('di-mvdov.index', compact('mvdov'));
    }
    public function keteranganBelumLengkap()
    {
        $cek = DesainIndustri::latest()->where('status','Keterangan Belum Lengkap')->get();
        return view('di-null.index', compact('cek'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function orang()
     {
        $orang = DesainIndustri::orderBy('nama_lengkap','asc')->get();
        return view('umum-page.Desainindustri.perorangan.index', compact('orang'));
     }
     public function cariOrang(Request $request)
     {
        $cario = $request->input('nama');
        $nama = DesainIndustri::orderBy('nama_lengkap','asc')->paginate(10);
        $orang = DesainIndustri::where('nama_lengkap',$cario)->orderBy('nama_lengkap', 'asc')->paginate(15);
        return view('umum-page.Desainindustri.perorangan.cari', compact('nama', 'orang', 'cario'));
     }
     public function jurusan()
     {
        return view('umum-page.Desainindustri.jurusan.index');
     }
     public function cariJurusan(Request $request)
     {
        $carij = $request->input('jurusan');
        $jurusan = DesainIndustri::where('jurusan',$carij)->paginate(10);
        return view('umum-page.Desainindustri.jurusan.cari', compact('jurusan','carij'));
    }
    public function prodi()
    {
        return view('umum-page.Desainindustri.prodi.index');
    }
    public function cariProdi(Request $request)
    {
        $cariprodi = $request->input('prodi');
        $prodi = DesainIndustri::where('prodi',$cariprodi)->paginate(10);
        return view('umum-page.Desainindustri.prodi.cari', compact('prodi', 'cariprodi'));
    }
    public function pengajuan()
    {
        return view('pengajuandi.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasidata = $request->validate([
            'nama_lengkap'=> 'required',
            'alamat'=> 'required',
            'no_telepon'=> 'required',
            'tanggal_lahir'=> 'required',
            'ktp_inventor'=> 'required|mimes:pdf',
            'email'=> 'required|email',
            'kewarganegaraan'=> 'required',
            'kode_pos'=> 'required',
            'jenis_di'=> 'required',
            'judul_di'=>'required',
            'uraian_di'=>'required|mimes:pdf',
            'gambar_di'=>'required|mimes:pdf',
            'surat_kepemilikan'=>'required|mimes:pdf',
            'surat_pengalihan'=>'required|mimes:pdf',
            'tanggal_permohonan'=>'required'
        ]);
        $di = new DesainIndustri();
        $di->nama_lengkap = $request->nama_lengkap;
        $di->alamat = $request->alamat;
        $di->no_telepon = $request->no_telepon;
        $di->tanggal_lahir = $request->tanggal_lahir;
        $di->email = $request->email;
        $di->kewarganegaraan = $request->kewarganegaraan;
        $di->kode_pos = $request->kode_pos;
        $di->jenis_di = $request->jenis_di;
        $di->judul_di = $request->judul_di;
        $di->tanggal_permohonan = $request->tanggal_permohonan;

        // File sensitif (data pribadi) disimpan di disk private
        $privateFiles = [
            'ktp_inventor'     => 'ktp_inventor',
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

        // Dokumen invensi (uraian & gambar) disimpan di disk public
        $publicFiles = ['uraian_di', 'gambar_di'];
        foreach ($publicFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $di->{$field} = $file->storeAs('dokumen-di', $filename, 'public');
            }
        }

        $di->save($validasidata);

        return redirect('/pengajuan-desain-industri')->with('success', 'Data desain industri berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $di = DesainIndustri::find($id);
        return view('di-show.index', compact('di'));
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
