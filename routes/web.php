<?php

use App\Services\PatenQueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PatenController;
use App\Http\Controllers\CheckerController;
use App\Http\Controllers\HakCiptaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\Api\ApiUsersController;
use App\Http\Controllers\DesainIndustriController;
use App\Http\Controllers\AdminVerifController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UmumPageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('umum-page.landing-page.index');
// });

Route::get('/', [UmumPageController::class, 'index']);

Route::get('/disclaimer', function () {
    return view('umum-page.disclaimer.index');
});
Route::get('/visi-misi', function () {
    return view('umum-page.visi-misi.index');
});
Route::get('/struktur-organisasi', function () {
    return view('umum-page.struktur.index');
});
Route::get('/panduan', function () {
    return view('umum-page.panduan.index');
});

Route::get('/pengajuan-paten', [PatenController::class, 'showPengajuan']);
Route::post('/simpanpaten', [PatenController::class, 'store']);

Route::post('/simpanhk', [HakCiptaController::class, 'store']);
Route::get('/pengajuan-hak-cipta', [HakCiptaController::class, 'pengajuan']);

Route::get('/pengajuan-desain-industri', [DesainIndustriController::class, 'pengajuan']);
Route::post('/simpandi', [DesainIndustriController::class, 'store']);

Route::get('/paten', [PatenController::class, 'index']);
Route::get('/paten/show/{id}', [PatenController::class, 'show'])->name('paten.show');

Route::get('/public/guest/dokumen-paten/{filename}', [PatenController::class, 'viewPublicFilesPatenGuest'])->name('public_paten_guest');
Route::get('/public/guest/dokumen-di/{filename}', [PatenController::class, 'viewPublicFilesDiGuest'])->name('public_di_guest');
Route::get('/public/guest/dokumen-hc/{filename}', [PatenController::class, 'viewPublicFilesHcGuest'])->name('public_hc_guest');

Route::get('/paten/pemeriksaan-formalitas', [PatenController::class, 'pemeriksaanFormalitas']);
Route::get('/paten/menunggu-tanggapan-formalitas', [PatenController::class, 'menungguTanggapan']);
Route::get('/paten/masa-pengumuman', [PatenController::class, 'masaPengumuman']);
Route::get('/paten/meunggu-pembayaran-substansif', [PatenController::class, 'pembayaranSubstansif']);
Route::get('/paten/substansif-tahap-awal', [PatenController::class, 'substansifAwal']);
Route::get('/paten/substansif-tahap-lanjut', [PatenController::class, 'substansifLanjut']);
Route::get('/paten/substansif-tahap-akhir', [PatenController::class, 'substansifAkhir']);
Route::get('/paten/menunggu-tanggapan-substansif', [PatenController::class, 'mengungguTanggapanSubstansif']);
Route::get('/paten/diberi', [PatenController::class, 'diberi']);
Route::get('/paten/ditolak', [PatenController::class, 'ditolak']);
Route::get('/paten/menunggu-verifikasi', [PatenController::class, 'mvdov']);
Route::post('/cari', [PatenController::class, 'cari'])->name('paten.cari');
Route::get('/paten/list/perorangan/', [PatenController::class, 'orang']);
Route::post('/paten/list/perorangan/cari', [PatenController::class, 'cariOrang']);
Route::get('/paten/list/jurusan/', [PatenController::class, 'jurusan']);
Route::post('/paten/list/jurusan/cari', [PatenController::class, 'cariJurusan']);
Route::get('paten/list/prodi/', [PatenController::class, 'prodi']);
Route::post('paten/list/prodi/cari', [PatenController::class, 'cariProdi'])->name('cari.paten.prodi');

Route::get('/hak-cipta', [HakCiptaController::class, 'index']);
Route::get('/hak-cipta/tercatat', [HakCiptaController::class, 'listTercatat']);
Route::get('/hak-cipta/ditolak', [HakCiptaController::class, 'tolak']);
Route::get('/hak-cipta/keterangan-belum-lengkap', [HakCiptaController::class, 'belumLengkap']);
Route::get('/hak-cipta/show/{id}', [HakCiptaController::class, 'show'])->name('hak-cipta.show');
Route::get('/hak-cipta/menunggu-verifikasi', [HakCiptaController::class, 'mvdov']);
Route::post('/hak-cipta/cari/data', [HakCiptaController::class, 'cari'])->name('hc.cari');
Route::get('/hak-cipta/list/pegawai/', [HakCiptaController::class, 'pegawai']);
Route::post('/hak-cipta/list/pegawai/cari', [HakCiptaController::class, 'cariPegawai']);
Route::get('/hak-cipta/list/jurusan/', [HakCiptaController::class, 'jurusan']);
Route::post('/hak-cipta/list/jurusan/cari', [HakCiptaController::class, 'cariJurusan']);
Route::get('/hak-cipta/list/prodi', [HakCiptaController::class, 'prodi']);
Route::post('/hak-cipta/list/prodi/cari', [HakCiptaController::class, 'cariProdi']);

Route::get('/desain-industri', [DesainIndustriController::class, 'index']);
Route::get('/desain-industri/diberi', [DesainIndustriController::class, 'diberi']);
Route::get('/desain-industri/dalam-proses-usulan', [DesainIndustriController::class, 'proses']);
Route::get('/desain-industri/pemeriksaan', [DesainIndustriController::class, 'pemeriksaan']);
Route::get('/desain-industri/ditolak', [DesainIndustriController::class, 'ditolak']);
Route::get('/desain-industri/keterangan-belum-lengkap', [DesainIndustriController::class, 'keteranganBelumLengkap']);
Route::get('/desain-industri/menunggu-verifikasi', [DesainIndustriController::class, 'mvdov']);
Route::get('/desain-industri/show/{id}', [DesainIndustriController::class, 'show'])->name('desain-industri.show');
Route::get('/desain-industri/list/pegawai', [DesainIndustriController::class, 'orang']);
Route::post('/desain-indstri/list/pegawai/cari', [DesainIndustriController::class, 'cariorang']);
Route::get('/desain-industri/list/jurusan', [DesainIndustriController::class, 'jurusan']);
Route::post('/desain-industri/list/jurusan/cari', [DesainIndustriController::class, 'cariJurusan']);
Route::get('/desain-industri/list/prodi', [DesainIndustriController::class, 'prodi']);
Route::post('/desain-industri/list/prodi/cari', [DesainIndustriController::class, 'cariProdi']);
Route::post('/desain-industri/cari/data', [DesainIndustriController::class, 'cari']);

Route::get('/login-admin', [AdminController::class, 'index'])->name('login.admin');
Route::post('/autentikasi', [AdminController::class, 'authenticate']);
Route::get('/logout', [LoginUserController::class, 'logout']);

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'portal']);
    Route::get('/admin/dashboard/kekayaan-intelektual', [AdminController::class, 'dashboardAdmin']);

    // Buat/kirim tagihan pembayaran (Admin) untuk Paten, Hak Cipta, Desain Industri
    Route::post('/admin/{jenis}/{id}/tagihan', [PaymentController::class, 'store'])->name('admin_payment.store');

    Route::get('/hak-cipta/{file}', [AdminHakCiptaController::class, 'viewSensitifFilesHc'])->middleware(['auth', 'role:Admin'])->name('private_hc');
    Route::get('/public/hak-cipta/{file}', [AdminHakCiptaController::class, 'viewPublicFilesHc'])->middleware(['auth', 'role:Admin'])->name('public_hc');

    Route::get('/admin/listadmin', [AdminController::class, 'lihat'])->middleware('auth');
    Route::get('/admin/listadmin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/listadmin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/listadmin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/admin/listadmin/tambah', [AdminController::class, 'create'])->name('admin.tambah');
    Route::get('/admin/listadmin/lihat/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::post('/simpan', [AdminController::class, 'store']);

    Route::get('/admin/pengguna/umum', [AdminController::class, 'lihatUmum'])->name('lihat.umum');
    Route::post('/admin/pengguna/umum/tambah', [AdminController::class, 'umumNew'])->name('tambah.umum');
    Route::post('/admin/pengguna/umum/update/{id}', [AdminController::class, 'updateUmum'])->name('umum.akun.update');
    Route::get('/admin/pengguna/umum/{id}', [AdminController::class, 'detailUmum'])->name('umum.detail');

    Route::get('/admin/pengguna/dosen', [AdminController::class, 'lihatDosen'])->name('lihat.dosen');
    Route::get('/admin/pengguna/dosen/{id}', [AdminController::class, 'detailDosen'])->name('detail.Dosen');
    Route::post('/admin/pengguna/dosen/tambah', [AdminController::class, 'dosenNew'])->name('tambah.dosen');
    Route::get('/admin/pengguna/dosen/hapus/{id}', [AdminController::class, 'hapusDosen'])->name('dosen.hapus');
    Route::post('admin/pengguna/dosen/edit/{id}', [AdminController::class, 'editDosen'])->name('dosen.edit');

    Route::get('/admin/verif', [AdminVerifController::class, 'lamanVerif']);
    Route::post('admin/verif/simpan', [AdminVerifController::class, 'tambahVerif'])->name('simpan.verif');
    Route::get('/admin/verif/hapus/{id}', [AdminVerifController::class, 'hapus'])->name('hapus.verif');
    Route::get('/admin/verif/lihat/{id}', [AdminVerifController::class, 'lihat'])->name('lihat.verif');
    Route::post('/admin/verif/update/{id}', [AdminVerifController::class, 'update'])->name('update.verif');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginUserController::class, 'index'])->name('login');
    Route::get('/register', [LoginUserController::class, 'regist']);
    Route::get('/register/dosen/', [LoginUserController::class, 'registDosen'])->name('regist.dosen');
    Route::get('/register/umum/', [LoginUserController::class, 'registUmum'])->name('regist.other');
    Route::post('/simpan/akun/', [LoginUserController::class, 'store'])->name('simpan.akun');
    Route::post('/autentikasi/user', [LoginUserController::class, 'autentikasi'])->name('autentikasi.user');
});

Route::middleware(['auth', 'role:Ketua KBK'])->group(function () {
    Route::get('/ketua-kbk/portal', [AdminController::class, 'portalKetuaKbk']);
});

Route::middleware(['auth', 'role:Dosen,Ketua KBK'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'index']);

    Route::get('/dosen/paten', [DosenController::class, 'paten']);
    Route::get('/dosen/pengajuan/paten', [DosenController::class, 'pengajuanPaten']);
    Route::post('/dosen/pengajuan/paten/simpan', [DosenController::class, 'storePaten'])->name('simpan.dosen.paten');
    Route::get('/dosen/paten/lihat/{id}', [DosenController::class, 'lihatPaten'])->name('dsn.paten.lihat');
    Route::get('/dosen/paten/edit/{id}', [DosenController::class, 'editPaten'])->name('dsn.edit.paten');
    Route::post('/dosen/paten/update/{id}', [DosenController::class, 'updatePaten'])->name('dsn.update.paten');
    Route::get('/dosen/paten/hapus/{id}', [DosenController::class, 'hapusPaten'])->name('dsn.paten.hapus');
    Route::get('/paten/cari', [DosenController::class, 'cariPaten']);

    Route::get('/dosen/hak-cipta', [DosenController::class, 'hakCipta']);
    Route::get('/dosen/hak-cipta/lihat/{id}', [DosenController::class, 'lihatHc'])->name('dsn.lihat.hc');
    Route::get('/dosen/hak-cipta/edit/{id}', [DosenController::class, 'editHc'])->name('dsn.edit.hc');
    Route::post('/dosen/hak-cipta/update/{id}', [DosenController::class, 'updateHc'])->name('dsn.update.hc');
    Route::get('/dosen/hak-cipta/pengajuan', [DosenController::class, 'pengajuanHc']);
    Route::post('/dosen/hak-cipta/pengajuan/simpan', [DosenController::class, 'storeHc']);

    Route::get('/private/dokumen-hc/{filename}', [DosenController::class, 'viewSensitifFilesHc'])->middleware(['auth', 'role:Dosen,Ketua KBK'])->name('private_hc_dosen');
    Route::get('/private/dokumen-di/{file}', [DosenController::class, 'viewSensitifFilesDi'])->middleware(['auth', 'role:Dosen,Ketua KBK'])->name('private_di_dosen');
    Route::get('/private/dokumen-paten/{filename}', [DosenController::class, 'viewSensitifFilesPaten'])->middleware('auth', 'role:Dosen,Ketua KBK')->name('private_paten_dosen');

    Route::get('/public/dokumen-paten/{filename}', [DosenController::class, 'viewPublicFilesPaten'])->middleware('auth', 'role:Dosen,Ketua KBK')->name('public_paten_dosen');
    Route::get('/public/dokumen-di/{filename}', [DosenController::class, 'viewPublicFilesDi'])->middleware('auth', 'role:Dosen,Ketua KBK')->name('public_di_dosen');
    Route::get('/public/dokumen-hc/{filename}', [DosenController::class, 'viewPublicFilesHc'])->middleware('auth', 'role:Dosen,Ketua KBK')->name('public_hc_dosen');

    Route::get('/hak-cipta/cari', [DosenController::class, 'cariHc']);
    Route::get('/dosen/desain-industri', [DosenController::class, 'desainIndustri']);
    Route::get('/dosen/desain-industri/pengajuan', [DosenController::class, 'pengajuanDi']);
    Route::get('/dosen/desain-industri/lihat/{id}', [DosenController::class, 'lihatDi'])->name('dsn.di.lihat');
    Route::get('/dosen/desain-industri/edit/{id}', [DosenController::class, 'editDi'])->name('dsn.edit.di');
    Route::post('/dosen/desain-industri/update/{id}', [DosenController::class, 'updateDi'])->name('dsn.update.di');
    Route::post('/dosen/desain-industri/pengajuan/simpan', [DosenController::class, 'storeDi']);
    Route::get('/desain-industri/cari', [DosenController::class, 'cariDi']);

    Route::get('/dosen/user/lihat/', [DosenController::class, 'lihatProfil']);
    Route::get('/dosen/user/edit/{id}', [DosenController::class, 'editProfil'])->name('dsn.profil.edit');
    Route::post('/dosen/user/update/{id}', [DosenController::class, 'updateProfil'])->name('dsn.update.profil');

    Route::get('/logout/dosen', [LoginUserController::class, 'logout']);
});

Route::middleware(['auth', 'role:Umum'])->group(function () {
    Route::get('/umum/dashboard', [UmumController::class, 'index']);
    Route::get('/umum/paten', [UmumController::class, 'paten']);
    Route::get('/umum/pengajuan/paten', [UmumController::class, 'pengajuanPaten']);
    Route::post('/umum/pengajuan/paten/simpan', [UmumController::class, 'simpanPaten'])->name('simpan.umum.paten');
    Route::get('/umum/paten/lihat/{id}', [UmumController::class, 'lihatPaten'])->name('umum.paten.lihat');
    Route::get('/umum/paten/edit/{id}', [UmumController::class, 'editPaten'])->name('umum.paten.edit');
    Route::post('/umum/paten/update/simpan/{id}', [UmumController::class, 'updatepaten'])->name('umum.paten.update');
    Route::get('/umum/paten/hapus/{id}', [UmumController::class, 'hapusPaten'])->name('umum.paten.hapus');
    Route::get('umum/paten/cari', [UmumController::class, 'cariPaten'])->name('umum.paten.cari');
    Route::get('umum/hak-cipta/cari', [UmumController::class, 'cariHc']);
    Route::get('umum/desain-industri/cari', [UmumController::class, 'cariDi']);

    Route::get('/umum/hak-cipta', [UmumController::class, 'hakCipta']);
    Route::get('/umum/hak-cipta/lihat/{id}', [UmumController::class, 'lihatHc'])->name('umum.hc.lihat');
    Route::get('/umum/hak-cipta/edit/{id}', [UmumController::class, 'editHc'])->name('umum.hc.edit');
    Route::get('/umum/hak-cipta/pengajuan', [UmumController::class, 'pengajuanHc']);
    Route::post('/umum/pengajuan/hak-cipta/simpan', [UmumController::class, 'simpanHc'])->name('simpan.umum.hc');
    Route::post('/umum/hak-cipta/update/simpan/{id}', [UmumController::class, 'updateHc'])->name('umum.hc.update');
    Route::get('/umum/hak-cipta/hapus/{id}', [UmumController::class, 'hapusHc'])->name('umum.hc.hapus');

    Route::get('/private/hc/umum/{filename}', [UmumController::class, 'viewSensitifFilesHc'])->middleware(['auth', 'role:Umum'])->name('private_hc_umum');
    Route::get('/private/di/umum/{file}', [UmumController::class, 'viewSensitifFilesDi'])->middleware(['auth', 'role:Umum'])->name('private_di_umum');
    Route::get('/private/paten/umum/{file}', [UmumController::class, 'viewSensitifFilesPaten'])->middleware(['auth', 'role:Umum'])->name('private_paten_umum');
    Route::get('/public/paten/umum/{file}', [UmumController::class, 'viewPublicFilesPaten'])->middleware(['auth', 'role:Umum'])->name('public_paten_umum');

    Route::get('/umum/desain-industri', [UmumController::class, 'desainIndustri']);
    Route::get('/umum/desain-industri/pengajuan', [UmumController::class, 'pengajuanDi']);
    Route::post('/umum/desain-industri/pengajuan/simpan', [UmumController::class, 'simpanDi'])->name('simpan.umum.di');
    Route::get('/umum/desain-industri/lihat/{id}', [UmumController::class, 'lihatDi'])->name('umum.di.lihat');
    Route::get('/umum/desain-industri/edit/{id}', [UmumController::class, 'editDi'])->name('umum.di.edit');
    Route::post('/umum/desain-industri/update/simpan/{id}', [UmumController::class, 'updateDi'])->name('umum.di.update');
    Route::get('/umum/desain-industri/hapus/{id}', [UmumController::class, 'hapusDi'])->name('umum.di.hapus');

    Route::get('/umum/user/lihat', [UmumController::class, 'lihatProfil'])->name('umum.profil.lihat');
    Route::get('/umum/user/edit/{id}', [UmumController::class, 'editProfil'])->name('umum.profil.edit');
    Route::post('/umum/profili/update/simpan/{id}', [UmumController::class, 'updateProfil'])->name('umum.profil.update');

    Route::get('/logout/umum/', [LoginUserController::class, 'logout'])->name('logout.umum');
});

Route::get('/login/verifikator', [CheckerController::class, 'loginChecker']);
Route::post('/login/verifikator/autentikasi', [CheckerController::class, 'autentikasi'])->name('autentikasi.checker');

Route::middleware(['auth', 'role:Checker'])->group(function () {
    Route::get('/verifikator/dashboard', [CheckerController::class, 'dashboard']);

    Route::get('/verifikator/cek/paten', [CheckerController::class, 'lamanPaten']);
    Route::get('/verifikator/cek/paten/lihat/{id}', [CheckerController::class, 'cekPaten'])->name('patencek.lihat');
    Route::get('/verifikator/cek/paten/nilai/{id}', [CheckerController::class, 'cek']);
    Route::post('/verifikator/cek/paten/nilai/simpan/{id}', [CheckerController::class, 'simpanCek'])->name('simpan.nilai');
    Route::get('verifikator/cek/paten/nilai/update/{id}', [CheckerController::class, 'lamanUpdatePaten']);
    Route::post('/verifikator/cek/paten/nilai/update/{id}', [CheckerController::class, 'updateCekPaten'])->name('update.cek.paten');
    Route::get('/verifikator/cek/paten/cari', [CheckerController::class, 'cariPaten']);

    Route::get('/private/cek/dokumen-paten/{file}', [CheckerController::class, 'viewSensitifFilesPaten'])->middleware(['auth', 'role:Checker'])->name('private_paten_verifikator');
    Route::get('/private/cek/dokumen-hc/{file}', [CheckerController::class, 'viewSensitifFilesHc'])->middleware(['auth', 'role:Checker'])->name('private_hc_verifikator');
    Route::get('/private/cek/dokumen-di/{file}', [CheckerController::class, 'viewSensitifFilesDi'])->middleware(['auth', 'role:Checker'])->name('private_di_verifikator');

    Route::get('/public/cek/dokumen-paten/{file}', [CheckerController::class, 'viewPublicFilesPaten'])->middleware(['auth', 'role:Checker'])->name('public_paten_verifikator');
    Route::get('/public/cek/dokumen-hc/{file}', [CheckerController::class, 'viewPublicFilesHc'])->middleware(['auth', 'role:Checker'])->name('public_hc_verifikator');
    Route::get('/public/cek/dokumen-di/{file}', [CheckerController::class, 'viewPublicFilesDi'])->middleware(['auth', 'role:Checker'])->name('public_di_verifikator');

    Route::get('/verifikator/cek/hak-cipta', [CheckerController::class, 'lamanHc']);
    Route::get('/verifikator/cek/hak-cipta/lihat/{id}', [CheckerController::class, 'cekHc'])->name('hccek.lihat');
    Route::get('/verifikator/cek/hak-cipta/nilai/{id}', [CheckerController::class, 'lamanCekhc'])->name('hccek.nilai');
    Route::post('/verifikator/cek/hak-cipta/nilai/simpan/{id}', [CheckerController::class, 'simpanCekhc'])->name('hcnilai.simpan');
    Route::get('/verifikator/cek/hak-cipta/nilai/update/{id}', [CheckerController::class, 'lamanUpdateCekhc']);
    Route::post('verifikator/cek/hak-cipta/nilai/update/simpan/{id}', [CheckerController::class, 'updateCekhc'])->name('hc.update.cek');
    Route::get('/verifikator/cek/hak-cipta/cari', [CheckerController::class, 'cariHc'])->name('cek.hc.cari');

    Route::get('/verifikator/cek/desain-industri', [CheckerController::class, 'lamanDi']);
    Route::get('verifikator/cek/desain-industri/lihat/{id}', [CheckerController::class, 'cekDi'])->name('lihat.desain');
    Route::get('/verifikator/cek/desain-industri/nilai/{id}', [CheckerController::class, 'lamanCekDi']);
    Route::post('verifikator/cek/desain-industri/nilai/simpan/{id}', [CheckerController::class, 'simpanCekDi'])->name('cekdi.simpan');
    Route::get('/verifikator/cek/desain-industri/nilai/update/{id}', [CheckerController::class, 'lamanUpdateCekDi'])->name('update.cekdi');
    Route::post('verifikator/cek/desain-industri/nilai/update/simpan/{id}', [CheckerController::class, 'updateCekDi'])->name('update.cekdi.simpan');
    Route::get('/verifikator/cek/desain-industri/cari', [CheckerController::class, 'cariDi']);

    Route::get('/verifikator/logout', [LoginUserController::class, 'logout']);
});

Route::get("/forget-password", [ForgetPasswordManager::class, "forgetPassword"])
    ->name("forget.password");
Route::post("/forget-password", [ForgetPasswordManager::class, "forgetPasswordPost"])
    ->name("forget.password.post");
Route::get("/reset-password/{token}", [ForgetPasswordManager::class, "resetPassword"])
    ->name("reset.password");
Route::post("/reset-password", [ForgetPasswordManager::class, "resetPasswordPost"])
    ->name("reset.password.post");

// ==== Pembayaran (Midtrans) ====
Route::middleware(['auth'])->group(function () {
    Route::get('/pembayaran/{order_id}', [PaymentController::class, 'show'])->name('payment.show');
});

// Webhook Midtrans - tanpa auth, CSRF di-exclude lewat bootstrap/app.php / VerifyCsrfToken
Route::post('/midtrans/notification', [PaymentController::class, 'notification'])->name('payment.notification');