<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;

/*
|--------------------------------------------------------------------------
| AdminKetuaKbkController
|--------------------------------------------------------------------------
| Dipindahkan dari AdminController milik Dashboard Produk Inovasi (lama).
| Hanya bagian pengelolaan akun "Ketua KBK" yang dimigrasikan ke sini —
| bagian pengelolaan akun "Admin" TIDAK ikut dipindah karena sudah ada
| menu Admin tersendiri di sisi Admin KI.
|
| Penyesuaian dari versi lama:
| 1. Namespace & lokasi pindah ke Modules\ProdukInovasi.
| 2. Nilai role 'ketua_kbk' -> 'Ketua KBK' (standar role hasil Fase 1
|    penggabungan tabel users).
| 3. View path memakai namespace module: 'produkinovasi::admin.ketua-kbk...'
*/
class AdminKetuaKbkController extends Controller
{
    public function ketuaKBK()
    {
        $kbk = User::with('kelompokKeahlian')->where('role', 'Ketua KBK')->paginate(10);
        $jenis_kbk = KelompokKeahlian::all();

        $kbk_navigasi = DB::table('kelompok_keahlians')
            ->select(
                'kelompok_keahlians.id',
                'kelompok_keahlians.nama_kbk'
            )
            ->get();

        return view('produkinovasi::admin.ketua-kbk.index', compact('kbk', 'jenis_kbk', 'kbk_navigasi'));
    }

    public function showDataKetuaKbk(string $id)
    {
        $kbk_navigasi = DB::table('kelompok_keahlians')
            ->select(
                'kelompok_keahlians.id',
                'kelompok_keahlians.nama_kbk'
            )
            ->get();

        $k_kbk = User::with('kelompokKeahlian')->find($id);

        return view('produkinovasi::admin.ketua-kbk.show.index', compact('k_kbk', 'kbk_navigasi'));
    }

    public function storeDataKetuaKbk(Request $request)
    {
        if ($request->ajax() && $request->has('check_unique')) {
            $field = $request->field;
            $value = $request->value;

            $exists = User::where($field, $value)->exists();

            return response()->json(['exists' => $exists]);
        }

        $validasi = $request->validate([
            'nama_lengkap' => 'required|string|unique:users,nama_lengkap',
            'nip' => 'required|numeric|digits_between:1,20|unique:users',
            'kbk_id' => 'required|exists:kelompok_keahlians,id',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required',
        ]);

        $k_kbk = new User();
        $k_kbk->nama_lengkap = $request->nama_lengkap;
        $k_kbk->nip = $request->nip;
        $k_kbk->kbk_id = $request->kbk_id;
        $k_kbk->no_telepon = $request->no_telepon;
        $k_kbk->email = $request->email;
        $k_kbk->jabatan = $request->jabatan;

        if ($request->hasFile('pas_foto')) {
            $originalName = $request->file('pas_foto')->getClientOriginalName();
            $fileName = time() . '_' . str_replace(' ', '_', $originalName);
            $path = $request->file('pas_foto')->storeAs('dokumen-user', $fileName);
            $k_kbk->pas_foto = $path;
        }

        $k_kbk->username = $request->username;
        $k_kbk->password = Hash::make($request->password);
        $k_kbk->role = $request->role;

        $k_kbk->save($validasi);

        return response()->json([
            'success' => true,
            'message' => 'Data ketua Kelompok Keahlian berhasil ditambahkan!',
        ]);
    }

    public function updateKetuaKbk(Request $request, $id)
    {
        if ($request->ajax() && $request->has('check_unique')) {
            $field = $request->field;
            $value = $request->value;

            $exists = User::where($field, $value)
                ->where('id', '!=', $id)
                ->exists();

            return response()->json(['exists' => $exists]);
        }

        $validasi = $request->validate([
            'nama_lengkap' => 'required|string',
            'nip' => 'required|numeric|digits_between:1,20|unique:users,email,' . $id,
            'kbk_id' => 'required|exists:kelompok_keahlians,id',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'jabatan' => 'required',
            'username' => 'required',
            'pas_foto' => 'file|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required',
        ]);

        $k_kbk = User::find($id);
        $k_kbk->nama_lengkap = $request->nama_lengkap;
        $k_kbk->nip = $request->nip;
        $k_kbk->kbk_id = $request->kbk_id;
        $k_kbk->no_telepon = $request->no_telepon;
        $k_kbk->email = $request->email;
        $k_kbk->jabatan = $request->jabatan;

        if ($request->hasFile('pas_foto')) {
            if ($k_kbk->pas_foto && Storage::exists($k_kbk->pas_foto)) {
                Storage::delete($k_kbk->pas_foto);
            }

            $originalName = $request->file('pas_foto')->getClientOriginalName();
            $fileName = time() . '_' . str_replace(' ', '_', $originalName);
            $path = $request->file('pas_foto')->storeAs('dokumen-user', $fileName);
            $k_kbk->pas_foto = $path;
        }

        $k_kbk->username = $request->username;
        $k_kbk->role = $request->role;

        $k_kbk->save($validasi);

        return response()->json([
            'success' => true,
            'message' => 'Data ketua Kelompok Keahlian berhasil diupdate!',
        ]);
    }

    public function hapusKetuaKbk(string $id)
    {
        $k_kbk = User::findOrFail($id);
        $k_kbk->delete();

        return redirect('/admin/ketua-kbk')->with('success', 'Data ketua Kelompok Keahlian berhasil dihapus');
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $user->password = bcrypt('@Polindra123');
        $user->save();

        return response()->json(['message' => 'Password berhasil direset menjadi "@Polindra123".']);
    }
}