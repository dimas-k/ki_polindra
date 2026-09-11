<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\ProdukInovasi\app\Models\Produk;
use Modules\ProdukInovasi\app\Models\Penelitian;
use Illuminate\Http\Request;
use Modules\ProdukInovasi\app\Models\KelompokKeahlian;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\ProdukInovasi\app\Models\AnggotaKelompokKeahlian;
use App\Models\Paten;
use App\Models\HakCipta;
use App\Models\DesainIndustri;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $kbk = KelompokKeahlian::all();
        $jumlah_kbk = KelompokKeahlian::all()->count();
        $jumlah_produk = Produk::where('status', 'Tervalidasi')->count();
        $jumlah_pusat_penelitian = Penelitian::where('status', 'Tervalidasi')->count();
        $produk = Produk::where('status', 'Tervalidasi')->get();
        $pusat_penelitian = Penelitian::where('status', 'Tervalidasi')->get();

        $produk_terbaru = Produk::where('status', 'Tervalidasi')->latest()->take(10)->get();
        $penelitian_terbaru = Penelitian::where('status', 'Tervalidasi')->latest()->take(10)->get();

        return view('produkinovasi::dashboard.index', compact('kbk', 'jumlah_kbk', 'jumlah_produk', 'jumlah_pusat_penelitian', 'produk', 'pusat_penelitian', 'produk_terbaru', 'penelitian_terbaru'));
    }

    public function contact()
    {
        $kbk = KelompokKeahlian::all();
        return view('produkinovasi::dashboard.contact.index', compact('kbk'));
    }

    public function penelitian($nama_kbk)
    {
        $kbk = KelompokKeahlian::all();
        $kbk_nama = KelompokKeahlian::find($nama_kbk);
        $kkbk = DB::table('users')
            ->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'users.id',
                'users.nama_lengkap',
                'users.pas_foto',
                'users.email',
                'kelompok_keahlians.nama_kbk',
                'kelompok_keahlians.deskripsi',
            )
            ->where('kelompok_keahlians.nama_kbk', '=', $nama_kbk)
            ->first();

        $anggota_kbk = DB::table('anggota_kelompok_keahlians')
            ->join('kelompok_keahlians', 'anggota_kelompok_keahlians.kbk_id', '=', 'kelompok_keahlians.id')
            ->where('kelompok_keahlians.nama_kbk', '=', $nama_kbk)
            ->select(
                'anggota_kelompok_keahlians.nama_lengkap',
                'anggota_kelompok_keahlians.jabatan'
            )
            ->get();

        $data_produk = DB::table('produks')
            ->join('kelompok_keahlians', 'produks.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'produks.id as id_produks',
                'produks.nama_produk as nama_produks',
                'produks.deskripsi as produk_deskripsi',
                'produks.gambar'
            )
            ->where('kelompok_keahlians.nama_kbk', '=', $nama_kbk)
            ->where('produks.status', 'Tervalidasi')
            ->groupBy('produks.id')
            ->latest('produks.created_at')
            ->get();

        $data_penelitian = DB::table('users')
            ->join('kelompok_keahlians', 'users.kbk_id', '=', 'kelompok_keahlians.id')
            ->join('penelitians', 'penelitians.kbk_id', '=', 'kelompok_keahlians.id')
            ->select(
                'penelitians.id as id_penelitian',
                'users.nama_lengkap',
                'users.nip',
                'users.jabatan',
                'users.no_telepon',
                'users.email',
                'kelompok_keahlians.nama_kbk',
                'kelompok_keahlians.jurusan',
                'penelitians.judul',
                'penelitians.abstrak',
                'penelitians.gambar',
                'penelitians.penulis',
                'penelitians.email_penulis',
                'penelitians.penulis_korespondensi',
                'penelitians.anggota_penulis_lainnya',
                'penelitians.lampiran',
            )->where('kelompok_keahlians.nama_kbk', '=', $nama_kbk)->where('status', 'Tervalidasi')->latest('penelitians.created_at')->get();

        return view('produkinovasi::dashboard.kelompok_keahlian.index', compact('kbk', 'kbk_nama', 'kkbk', 'data_produk', 'data_penelitian', 'anggota_kbk'));
    }

    public function detailProduk($nama_produk)
    {
        $kbk = KelompokKeahlian::all();
        $kbk_nama = KelompokKeahlian::where('nama_kbk', $nama_produk)->first();

        $produk = Produk::with(['kelompokKeahlian', 'anggota.anggota'])
            ->where('nama_produk', $nama_produk)
            ->firstOrFail();

        return view('produkinovasi::dashboard.detail-produk.index', compact('produk', 'kbk', 'kbk_nama'));
    }

    public function detailPenelitian($judul)
    {
        $kbk = KelompokKeahlian::all();
        $kbk_nama = KelompokKeahlian::where('nama_kbk', $judul)->first();

        $penelitian = Penelitian::with(['kelompokKeahlian', 'anggotaPenelitian.detailAnggota'])
            ->where('judul', $judul)
            ->firstOrFail();

        return view('produkinovasi::dashboard.detail-penelitian.index', compact('penelitian', 'kbk'));
    }

    public function dosenProduk($dosen)
    {
        $kbk = KelompokKeahlian::all();

        $anggota_user = User::where('nama_lengkap', $dosen)->first();
        $anggota_kbk = AnggotaKelompokKeahlian::where('nama_lengkap', $dosen)->first();

        $p_dosen = Produk::where(function ($query) use ($anggota_user, $anggota_kbk, $dosen) {
            if ($dosen) {
                $query->where(function ($query) use ($dosen) {
                    $query->where('anggota_inventor_lainnya', 'LIKE', '%' . $dosen . '%')
                        ->orWhere('inventor', 'LIKE', '%' . $dosen . '%')
                        ->orWhere('inventor_lainnya', 'LIKE', '%' . $dosen . '%');
                });
            }

            if ($anggota_kbk || $anggota_user) {
                $query->orWhereHas('anggota', function ($subQuery) use ($anggota_kbk, $anggota_user) {
                    $subQuery->where(function ($query) use ($anggota_kbk, $anggota_user) {
                        if ($anggota_kbk) {
                            $query->orWhere('anggota_id', $anggota_kbk->id);
                        }
                        if ($anggota_user) {
                            $query->orWhere('anggota_id', $anggota_user->id);
                        }
                    });
                });
            }
        })
            ->where('status', 'Tervalidasi')
            ->with(['kelompokKeahlian', 'anggota.detail'])
            ->paginate(4);

        $plt_dosen = Penelitian::where(function ($query) use ($anggota_kbk, $anggota_user,  $dosen) {
            if ($dosen) {
                $query->where('penulis', 'LIKE', '%' . $dosen . '%')->orwhere('penulis_lainnya', 'LIKE', '%' . $dosen . '%')->orWhere('penulis_korespondensi', 'LIKE', '%' . $dosen . '%')->orWhere('anggota_penulis_lainnya', 'LIKE', '%' . $dosen . '%');
            }
            if ($anggota_kbk || $anggota_user) {
                $query->orWhereHas('anggotaPenelitian', function ($subQuery) use ($anggota_kbk, $anggota_user) {
                    $subQuery->where(function ($query) use ($anggota_kbk, $anggota_user) {
                        if ($anggota_kbk) {
                            $query->orWhere('anggota_id', $anggota_kbk->id);
                        }
                        if ($anggota_user) {
                            $query->orWhere('anggota_id', $anggota_user->id);
                        }
                    });
                });
            }
        })->where('status', 'Tervalidasi')
            ->with(['kelompokKeahlian', 'anggotaPenelitian.detailAnggota'])
            ->paginate(4);

        return view('produkinovasi::dashboard.dosen-produk.index', [
            'kbk' => $kbk,
            'p_dosen' => $p_dosen,
            'plt_dosen' => $plt_dosen,
            'dosen' => $dosen,
            'anggota_user' => $anggota_user,
            'anggota_kbk' => $anggota_kbk,
        ]);
    }

    /**
     * Halaman detail daftar Karya Kekayaan Intelektual (Paten, Hak Cipta,
     * Desain Industri) yang datanya diambil dari SIKI Polindra.
     */
    public function karyaIntelektual()
    {
        $kbk = KelompokKeahlian::all();

        $paten = Paten::with('prodi.jurusan')
            ->where('status', 'Diberi')
            ->orderByDesc('tanggal_permohonan')
            ->get();

        $hakCipta = HakCipta::with('prodi.jurusan')
            ->where('status', 'Tercatat')
            ->orderByDesc('id')
            ->get();

        $desainIndustri = DesainIndustri::with('prodi.jurusan')
            ->where('status', 'Diberi')
            ->orderByDesc('id')
            ->get();

        return view('produkinovasi::dashboard.karya-intelektual.index', [
            'kbk' => $kbk,
            'paten' => $paten,
            'hakCipta' => $hakCipta,
            'desainIndustri' => $desainIndustri,
        ]);
    }

    public function katalogProduk()
    {
        $kbk = KelompokKeahlian::all();
        $produk = Produk::with('KelompokKeahlian')->where('status', 'Tervalidasi')->paginate(5);

        return view('produkinovasi::dashboard.katalog-produk.index', compact('produk', 'kbk'));
    }

    public function katalogProdukCari(Request $request)
    {
        $kbk = KelompokKeahlian::all();

        $cari = $request->input('cari_produk');
        $produk = Produk::with('KelompokKeahlian')->where('nama_produk', 'LIKE', "%" . $cari . "%")->where('status', 'Tervalidasi')->paginate(5);
        return view('produkinovasi::dashboard.katalog-produk.index', compact('produk', 'kbk'));
    }

    public function katalogPenelitian()
    {
        $kbk = KelompokKeahlian::all();
        $penelitian = Penelitian::with('KelompokKeahlian')->where('status', 'Tervalidasi')->paginate(5);

        return view('produkinovasi::dashboard.katalog-penelitian.index', compact('penelitian', 'kbk'));
    }

    public function katalogPenelitianCari(Request $request)
    {
        $kbk = KelompokKeahlian::all();
        $cari = $request->input('cari_penelitian');
        $penelitian = Penelitian::with('KelompokKeahlian')->where('judul', 'LIKE', "%" . $cari . "%")->where('status', 'Tervalidasi')->paginate(5);

        return view('produkinovasi::dashboard.katalog-penelitian.index', compact('penelitian', 'kbk'));
    }

    /**
     * ===== Berita / News (halaman publik) =====
     * $kbk WAJIB diambil di sini karena layout dashboard (dropdown
     * navigasi Kelompok Bidang Keahlian) butuh variabel ini di semua
     * halaman.
     */
    public function newsIndex(Request $request)
    {
        $kbk = KelompokKeahlian::all();

        $kategori = $request->input('kategori');
        $cari = $request->input('cari');

        $news = \Modules\ProdukInovasi\app\Models\News::published()
            ->when($kategori, fn($q) => $q->where('kategori', $kategori))
            ->when($cari, fn($q) => $q->where('judul', 'like', "%{$cari}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->withQueryString();

        $kategoriList = \Modules\ProdukInovasi\app\Models\News::published()
            ->whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('produkinovasi::dashboard.news.index', compact('news', 'kbk', 'kategoriList', 'kategori', 'cari'));
    }

    public function newsDetail(string $slug)
    {
        $kbk = KelompokKeahlian::all();

        $berita = \Modules\ProdukInovasi\app\Models\News::published()->where('slug', $slug)->firstOrFail();

        $terkait = \Modules\ProdukInovasi\app\Models\News::published()
            ->where('id', '!=', $berita->id)
            ->when($berita->kategori, fn($q) => $q->where('kategori', $berita->kategori))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('produkinovasi::dashboard.news-detail.index', compact('berita', 'kbk', 'terkait'));
    }
}