<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Modules\ProdukInovasi\app\Models\Penelitian;

class AdminPenelitianController extends Controller
{
    public function pagePenelitian($id)
    {
        $kbk_navigasi = KelompokKeahlian::select('id', 'nama_kbk')->get();
        $kbk_navigasi1 = KelompokKeahlian::select('id', 'nama_kbk')->where('id', $id)->first();

        $data_penelitian = Penelitian::with('kelompokKeahlian') ->where('kbk_id', $id) ->paginate(10);

        return view('produkinovasi::admin.penelitian.index', compact('kbk_navigasi', 'kbk_navigasi1', 'data_penelitian'));
    }
    public function showPenelitian($id)
    {
        $kbk_navigasi = KelompokKeahlian::select('kelompok_keahlians.id', 'kelompok_keahlians.nama_kbk')->get();
        // $penelitian = Penelitian::with(['kelompokKeahlian', 'penulisKorespondensi'])->find($id);
        $penelitian = Penelitian::with(['kelompokKeahlian', 'anggotaPenelitian.detailAnggota'])->findOrFail($id);

        // dd($penelitian->penulisKorespondensi->jabatan);
        return view('produkinovasi::admin.penelitian.show.index', compact('penelitian', 'kbk_navigasi'));
    }

    public function validatePenelitian(Request $request, $id)
    {
        $penelitian = Penelitian::findOrFail($id);
        $penelitian->status = $request->has('status') ? 'Tervalidasi' : 'Belum Divalidasi';
        $penelitian->save();
        return redirect()->route('admin.penelitian', ['id' => $penelitian->kbk_id])->with('success', 'Penelitian tervalidasi');

    }
}
