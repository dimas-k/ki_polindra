<?php

namespace App\Http\Controllers;

use App\Models\Paten;
use App\Models\HakCipta;
use Illuminate\Http\Request;
use App\Models\DesainIndustri;
use Illuminate\Routing\Controller;

class HakCiptaController extends Controller
{
    public function index()
    {
        $itung = HakCipta::all()->count();
        $tercatat = HakCipta::where('status', 'Tercatat')->count();
        $null = HakCipta::where('status', 'Keterangan Belum Lengkap')->count();
        $tolak = HakCipta::where('status', 'Ditolak')->count();
        $hc = HakCipta::latest()->paginate(5);

        $hcTolak = HakCipta::where('status', 'Ditolak')->count();
        $hcTerima = HakCipta::where('status', 'Tercatat')->count();
        $hcKet = HakCipta::where('status', 'Keterangan belum lengkap')->count();
        $mvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        $data = HakCipta::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
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


        return view('umum-page.Hakcipta.index', compact('hc', 'tercatat', 'null', 'tolak', 'itung', 'hcTolak', 'hcTerima', 'hcKet', 'tahun','jumlah', 'mvdov'));
    }
    public function cari(Request $request)
    {
        $carijudul = $request->input('cari_hc');
        $carinama = $request->input('cari_nama');
        // $hc = HakCipta::where('judul_ciptaan','LIKE',"%".$carijudul."%")->orWhere('nama_lengkap','LIKE',"%".$carinama."%")->paginate(5);
        $hc = HakCipta::when($carijudul, function ($query, $carijudul) {
            return $query->where('judul_ciptaan', 'LIKE', "%" . $carijudul . "%");
        })
            ->when($carinama, function ($query, $carinama) {
                return $query->orWhere('nama_lengkap', 'LIKE', "%" . $carinama . "%");
            })
            ->paginate(5);
        $itung = HakCipta::all()->count();
        $tercatat = HakCipta::where('status', 'Tercatat')->count();
        $null = HakCipta::where('status', 'Keterangan Belum Lengkap')->count();
        $tolak = HakCipta::where('status', 'Ditolak')->count();
        $mvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();

        $hcTolak = HakCipta::where('status', 'Ditolak')->count();
        $hcTerima = HakCipta::where('status', 'Tercatat')->count();
        $hcKet = HakCipta::where('status', 'Keterangan belum lengkap')->count();

        $data = HakCipta::selectRaw('YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah')
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
        return view('umum-page.Hakcipta.index', compact('hc', 'tercatat', 'null', 'tolak', 'itung', 'hcTolak', 'hcTerima', 'hcKet', 'tahun','jumlah', 'mvdov'));
    }

    public function listTercatat()
    {
        $cek = HakCipta::latest()->where('status', 'Tercatat')->get();
        return view('hc-tercatat.index', compact('cek'));
    }
    public function belumLengkap()
    {
        $cek = HakCipta::latest()->where('status', 'Keterangan Belum Lengkap')->get();
        return view('hc-kbl.index', compact('cek'));
    }
    public function tolak()
    {
        $cek = HakCipta::latest()->where('status', 'Ditolak')->get();
        return view('hc-t.index', compact('cek'));
    }
    public function mvdov()
    {
        $mvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->get();
        return view('hc-mvdov.index', compact('mvdov'));
    }
    public function pegawai()
    {
        $orang = HakCipta::orderBy('nama_lengkap', 'asc')->get();
        return view('umum-page.Hakcipta.perorangan.index', compact('orang'));
    }
    public function cariPegawai(Request $request)
    {
        $cario = $request->input('nama');
        $nama = HakCipta::orderBy('nama_lengkap', 'asc')->paginate(10);
        $orang = HakCipta::where('nama_lengkap', $cario)->orderBy('nama_lengkap', 'asc')->paginate(15);
        return view('umum-page.Hakcipta.perorangan.cari', compact('nama', 'orang', 'cario'));
    }
    public function jurusan()
    {
        return view('umum-page.Hakcipta.jurusan.index');
    }
    public function cariJurusan(Request $request)
    {
        $carij = $request->input('jurusan');
        $jurusan = HakCipta::where('jurusan', $carij)->paginate(10);
        return view('umum-page.Hakcipta.jurusan.cari', compact('jurusan','carij'));
    }
    public function prodi()
    {
        return view('umum-page.Hakcipta.prodi.index');
    }
    public function cariProdi(Request $request)
    {
        $cariprodi = $request->input('prodi');
        $prodi = HakCipta::where('prodi', 'LIKE', $cariprodi )->paginate(10);
        return view('umum-page.Hakcipta.prodi.cari', compact('prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pengajuan()
    {
        return view('pengajuanhk.index');
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
            'email' => 'required|email',
            'kewarganegaraan' => 'required',
            'kode_pos' => 'required',
            'jenis_ciptaan' => 'required',
            'judul_ciptaan' => 'required',
            'uraian_singkat' => 'required|max:60000',
            'dokumen_invensi' => 'required|mimes:pdf',
            'surat_pengalihan' => 'required|mimes:pdf',
            'surat_pernyataan' => 'required|mimes:pdf',
            'tanggal_permohonan' => 'required'

        ]);

        $hc = new HakCipta();
        $hc->nama_lengkap = $request->nama_lengkap;
        $hc->alamat = $request->alamat;
        $hc->no_telepon = $request->no_telepon;
        $hc->tanggal_lahir = $request->tanggal_lahir;
        $hc->email = $request->email;
        $hc->kewarganegaraan = $request->kewarganegaraan;
        $hc->kode_pos = $request->kode_pos;
        $hc->jenis_ciptaan = $request->jenis_ciptaan;
        $hc->judul_ciptaan = $request->judul_ciptaan;
        $hc->uraian_singkat = $request->uraian_singkat;
        $hc->tanggal_permohonan = $request->tanggal_permohonan;

        // File sensitif (data pribadi) disimpan di disk private
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

        // Dokumen invensi disimpan di disk public
        if ($request->hasFile('dokumen_invensi')) {
            $file = $request->file('dokumen_invensi');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $hc->dokumen_invensi = $file->storeAs('dokumen-hc', $filename, 'public');
        }

        $hc->save($validasidata);

        return redirect('/pengajuan-hak-cipta')->with('success', 'Data hak cipta berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hc = HakCipta::find($id);
        return view('hcshow.index', compact('hc'));
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
