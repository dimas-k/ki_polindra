<?php

namespace App\Http\Controllers;

use App\Models\CheckDi;
use App\Models\DesainIndustri;
use App\Models\Paten;
use App\Models\Checker;
use App\Models\CheckHc;
use App\Models\CheckPaten;
use App\Models\HakCipta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Relations\HasOne;

class CheckerController extends Controller
{
    public function dashboard()
    {
        $paten = Paten::all()->count();
        $hc = HakCipta::all()->count();
        $di = DesainIndustri::all()->count();
        return view('checker.dashboard.index', compact('paten', 'hc', 'di'));
    }
    public function loginChecker()
    {
        return view('checker.login.index');
    }
    public function autentikasi(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd($request);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/verifikator/dashboard');
        }

        return back()->with('loginError', 'Login Gagal!');
    }
    public function lamanPaten()
    {
        $paten = Paten::with('cek')->paginate(10);
        // dd($paten);
        return view('checker.cekpaten.index', compact('paten'));
    }
    public function cariPaten(Request $request)
    {
        $cari = $cari = $request->input('cari');
        $paten = Paten::with('cek')->where('judul_paten', 'LIKE', "%" . $cari . "%")->orWhere('nama_lengkap', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%")->paginate(5);
        return view('checker.cekpaten.index', compact('paten'));
    }
    public function cekPaten(string $id)
    {
        // $paten = Paten::with('cek')->find($id);
        // Misalnya, $paten merupakan data paten utama (bukan data verifikasi)
        $paten = Paten::findOrFail($id);

        // Cek apakah data paten sudah pernah dinilai.
        // Jika di tabel check_paten, paten_id merupakan foreign key ke tabel patens,
        // sebaiknya kita cari berdasarkan paten_id.
        $check = CheckPaten::where('paten_id', $id)->first();

        return view('checker.cekpaten.lihat.index', compact('paten','check'));
    }

    public function viewSensitifFilesPaten($filename)
    {
        $paten = \App\Support\PatenPrivateFile::findRecord($filename);
        if (!$paten) {
            abort(404, 'File tidak ditemukan.');
        }
        return \App\Support\PatenPrivateFile::response($filename);
    }


    public function viewSensitifFilesHc($filename)
    {
        return \App\Support\KiPrivateFile::responseForStaff('hc', $filename);
    }

    public function viewSensitifFilesDi($filename)
    {
        return \App\Support\KiPrivateFile::responseForStaff('di', $filename);
    }

    public function viewPublicFilesPaten($filename)
    {
        $paten = \App\Support\PatenPrivateFile::findRecord($filename);
        if (!$paten) {
            abort(404, 'File tidak ditemukan.');
        }
        return \App\Support\PatenPrivateFile::response($filename);
    }


    public function viewPublicFilesHc($filename)
    {
        return \App\Support\KiPrivateFile::responseForStaff('hc', $filename);
    }

    public function viewPublicFilesDi($filename)
    {
        return \App\Support\KiPrivateFile::responseForStaff('di', $filename);
    }

    public function cek(string $id)
    {
        // Cari data verifikasi berdasarkan paten_id
        $check = CheckPaten::where('paten_id', $id)->first();
        if ($check !== null) {
            return back()->with('warning', 'Data Paten sudah dinilai. Silahkan gunakan tombol Update jika ada perubahan.');
        }
        return view('checker.cekpaten.nilai.index');
    }
    

    public function lamanUpdatePaten(string $id)
    {
        $check = CheckPaten::where('paten_id', $id)->first();
        if ($check === null) {
            return back()->with('warning', 'Data Paten belum dinilai. Silahkan lakukan penilaian terlebih dahulu.');
        }
        // dd($check->cek_data);
        return view('checker.cekpaten.update.index', compact('check'));
    }
    

    public function updateCekPaten(Request $request, string $id)
    {
        $validasi = $request->validate([
            'cek_data' => 'required',
            'keterangan' => 'required'
        ]);

        $cek = CheckPaten::find($id);
        $cek->paten_id = $id;
        $cek->cek_data = $request->cek_data;
        $cek->keterangan = $request->keterangan;
        $cek->save($validasi);

        return redirect('/verifikator/cek/paten')->with('success', 'verifikasi Data Paten Berhasil diupdate!');
    }
    public function simpanCek(Request $request, string $id)
    {
        $validasi = $request->validate([
            'cek_data' => 'required',
            'keterangan' => 'required'
        ]);

        $cek = new CheckPaten();
        $cek->paten_id = $id;
        $cek->cek_data = $request->cek_data;
        $cek->keterangan = $request->keterangan;
        $cek->save($validasi);

        return redirect('/verifikator/cek/paten')->with('success', 'Data Paten berhasil diverifikasi!');
    }

    public function lamanHc()
    {
        $hc = HakCipta::with('cekHc')->paginate(5);
        return view('checker.cekhc.index', compact('hc'));
    }

    public function lamanCekHc(string $id)
    {
        $hc = CheckHc::find($id);
        if ($hc !== null) {
            return back()->with('warning', 'Data Hak Cipta Sudah diverifikasi, Silahkan Update Data Jikalau Ada Perubahan');
        } else {
            return view('checker.cekhc.nilai.index');
        }
    }

    public function lamanUpdateCekhc(string $id)
    {
        $check = CheckHc::where('hak_cipta_id', $id)->first();
        if ($check === null) {
            return back()->with('warning', 'Data Paten belum dinilai. Silahkan lakukan penilaian terlebih dahulu.');
        }

        return view('checker.cekhc.update.index', compact('check'));
        
    }
    public function cekHc(string $id)
    {
        $hc = HakCipta::with('cekHc')->find($id);
        $check = CheckHc::where('hak_cipta_id', $id)->first();
    
        // Jika data sudah dinilai, flash pesan warning (opsional)
        if ($check !== null) {
            session()->flash('warning', 'Data Hak Cipta sudah dinilai. Silahkan gunakan tombol Update jika ada perubahan.');
        }
    
        // Selalu return view detail
        return view('checker.cekhc.lihat.index', compact('hc', 'check'));
    }
    

    public function cariHc(Request $request)
    {
        $cari = $request->input('cari');
        $hc = HakCipta::with('cekhc')->where('judul_ciptaan', 'LIKE', "%" . $cari . "%")->orWhere('nama_lengkap', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%")->paginate(5);
        return view('checker.cekhc.index', compact('hc'));
    }

    public function simpanCekHc(Request $request, string $id)
    {
        $validasi = $request->validate([
            'cek_data' => 'required',
            'keterangan' => 'required'
        ]);

        $cek = new CheckHc();
        $cek->hak_cipta_id = $id;
        $cek->cek_data = $request->cek_data;
        $cek->keterangan = $request->keterangan;
        $cek->save($validasi);

        return redirect('/verifikator/cek/hak-cipta')->with('success', 'Data Hak Cipta Berhasil diverifikasi!');
    }

    public function updateCekHc(Request $request, string $id)
    {
        $validasi = $request->validate([
            'cek_data' => 'required',
            'keterangan' => 'required'
        ]);

        $cek = CheckHc::find($id);
        $cek->hak_cipta_id = $id;
        $cek->cek_data = $request->cek_data;
        $cek->keterangan = $request->keterangan;
        $cek->save($validasi);

        return redirect('/verifikator/cek/hak-cipta')->with('success', 'verifikasi Hak Cipta Berhasil diupdate!');
    }
    public function lamanDi()
    {
        $di = DesainIndustri::with('cekDi')->paginate(5);
    
        return view('checker.cekdi.index', compact('di'));
    }
    public function cariDi(Request $request)
    {
        $cari = $cari = $request->input('cari');
        $di = DesainIndustri::with('cekDi')->where('judul_di', 'LIKE', "%" . $cari . "%")->orWhere('nama_lengkap', 'LIKE', "%" . $cari . "%")->orWhere('status', 'LIKE', "%" . $cari . "%")->paginate(5);
        return view('checker.cekdi.index', compact('di'));
    }
    public function cekDi(string $id)
    {
        $di = DesainIndustri::with('cekDi')->find($id);
        $check = CheckDi::where('desain_industri_id', $id)->first();
        // Jika data sudah dinilai, flash pesan warning (opsional)
        if ($check !== null) {
            session()->flash('warning', 'Data Hak Cipta sudah dinilai. Silahkan gunakan tombol Update jika ada perubahan.');
        }
        return view('checker.cekdi.lihat.index', compact('di','check'));
    }
    public function lamanCekDi(string $id)
    {
        $di = CheckDi::find($id);
        if ($di != null) {
            return back()->with('warning', 'Data Desain Industri Sudah diverifikasi, Silahkan Update Data Jikalau Ada Perubahan');
        } else {

            return view('checker.cekdi.nilai.index');
        }
    }

    public function simpanCekDi(Request $request, string $id)
    {
        $validasi = $request->validate([
            'cek_data' => 'required',
            'keterangan' => 'required'
        ]);

        $cek = new CheckDi();
        $cek->desain_industri_id = $id;
        $cek->cek_data = $request->cek_data;
        $cek->keterangan = $request->keterangan;
        $cek->save($validasi);

        return redirect('/verifikator/cek/desain-industri')->with('success', 'Data Desain industri berhasil diverifikasi!');
    }
    public function updateCekDi(Request $request, string $id)
    {
        $validasi = $request->validate([
            'cek_data' => 'required',
            'keterangan' => 'required'
        ]);
        $updatedi = CheckDi::find($id);
        $updatedi->desain_industri_id = $id;
        $updatedi->cek_data = $request->cek_data;
        $updatedi->keterangan = $request->keterangan;
        $updatedi->save($validasi);
        return redirect('/verifikator/cek/desain-industri')->with('success', 'Verifikasi Desain Industri Berhasil diupdate!');
    }
    public function lamanUpdateCekDi(string $id)
    {
        $di = CheckDi::find($id);

        $check = CheckDi::where('desain_industri_id', $id)->first();
        if ($check === null) {
            return back()->with('warning', 'Data Paten belum dinilai. Silahkan lakukan penilaian terlebih dahulu.');
        }
        return view('checker.cekdi.update.index', compact('di','check'));
        
    }
    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login/verifikator');
    }
}
