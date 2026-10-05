<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use Modules\ProdukInovasi\app\Models\Produk;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class AdminProdukInovasiController extends Controller
{
    public function pageProduk($id)
    {
        $kbk_navigasi1 = KelompokKeahlian::select('id', 'nama_kbk')->where('id', $id)->first();
        $data_produk = Produk::with('kelompokKeahlian') ->where('kbk_id', $id) ->paginate(10); 


        return view('produkinovasi::admin.produk.index', compact('kbk_navigasi1', 'data_produk'));
    }

    public function ShowPageProduk($id)
    {
        $produk = Produk::with('KelompokKeahlian')->findOrFail($id);
        return view('produkinovasi::admin.produk.show.index', compact('produk'));
    }

    public function validateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->status = $request->has('status') ? 'Tervalidasi' : 'Belum Divalidasi';
        $produk->save();

        return redirect()->route('admin.produk', ['id' => $produk->kbk_id])->with('success', 'Produk tervalidasi');
    }
}
