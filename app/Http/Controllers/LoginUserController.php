<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ActivityLog;

class LoginUserController extends Controller
{
    public function index()
    {
        return view('login-user.login.index');
    }
    public function regist()
    {
        return view('login-user.regist.index');
    }
    public function registDosen()
    {
        return view('login-user.regist.dosen.index');
    }
    public function registUmum()
    {
        return view('login-user.regist.other.index');
    }

    public function autentikasi(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',


        ]);

        // dd($request);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'Dosen') {
                return redirect('/dosen/dashboard');
            } elseif (Auth::user()->role == 'Umum') {
                return redirect('/umum/dashboard');
            } elseif (Auth::user()->role == 'Admin') {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->role == 'Checker') {
                return redirect('/verifikator/dashboard');
            } elseif (Auth::user()->role == 'Ketua KBK') {
                return redirect('/k-kbk/dashboard');
            }
        }
        return back()->with('loginError', 'Login Gagal!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasidata = $request->validate([
            'nama_lengkap' => 'required|string',
            'no_telepon' => 'required|string',
            'email' => 'required|email:dns|unique:users',
            'nip' => 'nullable|integer|unique:users',
            'username' => 'required|min:5|unique:users|string',
            'password' => 'required|min:5|max:15'
        ]);

        // Menentukan role berdasarkan logika backend
        $role = $this->determineRole($request);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'kerjaan' => $request->kerjaan,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $role // Role dari backend
        ]);
        $user->save($validasidata);

        // Mengarahkan pengguna berdasarkan role
        if ($role == 'Dosen') {
            return redirect()->intended('register/dosen/')->with('success', 'Data anda telah ditambahkan');
        } else {
            return redirect()->intended('register/umum/')->with('success', 'Data anda telah ditambahkan');
        }
    }

    // Fungsi untuk menentukan role berdasarkan logika backend
    private function determineRole(Request $request)
    {
        if ($request->nip && $request->jabatan) {
            // Jika NIP diisi, dianggap sebagai Dosen
            return 'Dosen';
        }
        // Jika tidak ada NIP, role default adalah 'Umum'
        return 'Umum';
    }


    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
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
