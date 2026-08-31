<?php

namespace App\Http\Controllers;

use App\Models\Paten;

use App\Models\HakCipta;
use Illuminate\Http\Request;
use App\Models\DesainIndustri;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.loginadmin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd($request);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function portal()
    {
        return view('admin.portal.index');
    }
    public function dashboardAdmin()
    {
        $paten = Paten::all();
        $hc = HakCipta::all();
        $di = DesainIndustri::all();
        //paten
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
        $patenmvdov = Paten::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();
        //desain Industri
        $desainDi = DesainIndustri::where('status', 'Diberi')->count();
        $desainDK = DesainIndustri::where('status', 'Ditolak')->count();
        $desainP = DesainIndustri::where('status', 'Pemeriksaan')->count();
        $desainKBL = DesainIndustri::where('status', 'Keterangan belum lengkap')->count();
        $desainDPU = DesainIndustri::where('status', 'Dalam proses usulan')->count();
        $dmvdov = DesainIndustri::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();
        ///hak cipta
        $hcTolak = HakCipta::where('status', 'Ditolak')->count();
        $hcTerima = HakCipta::where('status', 'Diterima')->count();
        $hcKet = HakCipta::where('status', 'Keterangan belum lengkap')->count();
        $hcmvdov = HakCipta::where('status', 'Menunggu Verifikasi Data Oleh Verifikator')->count();
        return view('admin.dashboard.index', compact('paten', 'hc', 'di', 'patenPF', 'patenMTF', 'patenMP', 'patenMPS', 'patenSTAW', 'patenSTL', 'patenSTAK', 'patenMTS', 'patenDI', 'patenDK', 'desainDi', 'desainDK', 'desainP', 'desainKBL', 'desainDPU', 'hcTolak', 'hcTerima', 'hcKet', 'patenmvdov', 'dmvdov', 'hcmvdov'));
    }



    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login-admin');
    }



    public function lihat()
    {
        $admin = User::where('role', 'Admin')->get();
        return view('admin.admin-page.index', compact('admin'));
    }
    public function lihatDosen()
    {
        $dosen = User::where('role', 'Dosen')->orderBy('nama_lengkap', 'asc')->get();

        return view('admin.dosen-page.index', compact('dosen'));
    }
    public function detailDosen($id)
    {
        $dsn = User::find($id);
        return view('admin.dosen-page.lihat.index', compact('dsn'));
    }
    public function detailUmum($id)
    {
        $um = User::find($id);

        return view('admin.umum.lihat.index', compact('um'));
    }

    public function dosenNew(Request $request)
    {
        $validasidata = $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|min:3',
            'password' => 'required|max:10',
            'nip' => 'required|unique:users'

        ]);
        $user = new User;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->kerjaan = $request->kerjaan;
        $user->jabatan = $request->jabatan;
        $user->nip = $request->nip;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save($validasidata);

        return redirect('/admin/pengguna/dosen')->with('success', 'Data dosen telah ditambahkan');
    }
    public function editDosen(Request $request, string $id)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users',
            'username' => 'required|min:3',
            'password' => 'required|max:10',
            'nip' => 'required|unique:users',
        ]);
        $user = User::find($id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->nip = $request->nip;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save($validasidata);

        return redirect('/admin/pengguna/dosen')->with('success', 'Data dosen telah diubah');
    }
    public function hapusDosen(string $id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
    public function lihatUmum()
    {
        $umum = User::where('role', 'Umum')->orderBy('nama_lengkap', 'asc')->get();
        return view('admin.umum.index', compact('umum'));
    }
    public function umumNew(Request $request)
    {
        $validasidata = $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|min:3',
            'password' => 'required|max:10'

        ]);
        $user = new User;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->kerjaan = $request->kerjaan;
        // $user->jabatan = $request->jabatan;
        // $user->nip = $request->nip;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save($validasidata);

        return redirect('/admin/pengguna/umum')->with('success', 'Data umum telah ditambahkan');
    }
    public function updateUmum(Request $request, string $id)
    {
        $validasidata = $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|min:3',
            'password' => 'required|max:10',
            // 'ktp'=>'required|mimes:pdf|max:2028',
        ]);
        $user = User::find($id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->no_telepon = $request->no_telepon;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        // $user->ktp = $request->file('ktp')->store('dokumen_user');
        $user->kerjaan = $request->kerjaan;
        // $user->jabatan = $request->jabatan;
        // $user->nip = $request->nip;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save($validasidata);

        return redirect('/admin/pengguna/umum')->with('success', 'Data akun umum telah diubah');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-page.tambah-admin.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasidata = $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|max:10'
        ]);
        $user = new User;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->jabatan = $request->jabatan;
        $user->alamat = $request->alamat;
        $user->no_telepon = $request->no_telepon;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save($validasidata);

        return redirect('/admin/listadmin')->with('success', 'Data admin telah ditabahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = User::find($id);
        return view('admin.admin-page.show.index', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.admin-page.editadmin.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->jabatan = $request->jabatan;
        $user->alamat = $request->alamat;
        $user->no_telepon = $request->no_telepon;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/listadmin')->with('success', 'Data admin berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Akun Admin telah dihapus!');
    }
}
