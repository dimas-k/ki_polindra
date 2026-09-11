<?php

use Illuminate\Support\Facades\Route;
use Modules\ProdukInovasi\app\Http\Controllers\DashboardController;
use Modules\ProdukInovasi\app\Http\Controllers\KetuaKbkController;
use Modules\ProdukInovasi\app\Http\Controllers\KelompokBidangController;
use Modules\ProdukInovasi\app\Http\Controllers\AdminPenelitianController;
use Modules\ProdukInovasi\app\Http\Controllers\AdminProdukInovasiController;
use Modules\ProdukInovasi\app\Http\Controllers\AdminKetuaKbkController;
use Modules\ProdukInovasi\app\Http\Controllers\AdminNewsController;

/*
|--------------------------------------------------------------------------
| Route Modul Produk Inovasi
|--------------------------------------------------------------------------
| Dipindahkan dari routes/web.php Dashboard Produk Inovasi (Fase 3
| penggabungan sistem), dengan penyesuaian:
|
| 1. Semua route publik (dulu di root '/', 'dashboard/*') dipindah ke
|    prefix '/produk-inovasi', karena '/' sudah dipakai landing page SIKI.
| 2. Middleware 'role:admin' -> 'role:Admin' dan 'role:ketua_kbk' ->
|    'role:Ketua KBK', menyesuaikan standar nilai role hasil Fase 1
|    (satukan tabel users).
| 3. Route login/logout/register TIDAK dipindah ke sini — sudah disatukan
|    ke LoginUserController milik SIKI Polindra (satu form login untuk
|    semua role: Admin, Dosen, Umum, Checker, Ketua KBK).
*/

// ===== Halaman publik (etalase Produk Inovasi & Penelitian) =====
Route::prefix('dproin-polindra')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/kontak', [DashboardController::class, 'contact']);
    Route::get('/kelompok-bidang-keahlian/{nama_kbk}', [DashboardController::class, 'penelitian'])->name('dashboard.penelitian');
    Route::get('/produk/detail/{nama_produk}', [DashboardController::class, 'detailProduk'])->name('detail.produk');
    Route::get('/penelitian/detail/{judul}', [DashboardController::class, 'detailPenelitian'])->name('detail.penelitian');
    Route::get('/produk-dan-penelitian/list/{dosen}', [DashboardController::class, 'dosenProduk'])->name('produk.dosen');

    Route::get('/karya-intelektual', [DashboardController::class, 'karyaIntelektual'])->name('karya-intelektual.index');

    Route::get('/katalog/produk-inovasi', [DashboardController::class, 'katalogProduk']);
    Route::post('/katalog/produk-inovasi/cari', [DashboardController::class, 'katalogProdukCari']);

    Route::get('/katalog/penelitian', [DashboardController::class, 'katalogPenelitian']);
    Route::post('/katalog/penelitian/cari', [DashboardController::class, 'katalogPenelitianCari']);

    Route::get('/berita', [DashboardController::class, 'newsIndex'])->name('news.index');
    Route::get('/berita/{slug}', [DashboardController::class, 'newsDetail'])->name('news.show');
});

// ===== Area Admin (produk/penelitian/KBK) — role disamakan ke 'Admin' =====
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/kelompok-bidang-keahlian', [KelompokBidangController::class, 'pageKelompokBidang']);
    Route::post('/admin/kelompok-bidang-keahlian/create', [KelompokBidangController::class, 'storeKelompokKeahlian']);
    Route::post('/admin/kelompok-bidang-keahlian/update/{id}', [KelompokBidangController::class, 'update'])->name('updateKelompokBidang');
    Route::delete('/admin/kelompok-bidang-keahlian/delete/{id}', [KelompokBidangController::class, 'hapusKbk'])->name('hapusKbk');

    Route::get('/admin/produk-inovasi/{id}', [AdminProdukInovasiController::class, 'pageProduk'])->name('admin.produk');
    Route::get('/admin/produk-inovasi/show/{id}', [AdminProdukInovasiController::class, 'ShowPageProduk'])->name('show.produk');
    Route::put('/admin/produk-inovasi/edit-status/{id}', [AdminProdukInovasiController::class, 'validateProduk'])->name('validate.produk');

    Route::get('/admin/penelitian/{id}', [AdminPenelitianController::class, 'pagePenelitian'])->name('admin.penelitian');
    Route::get('/admin/penelitian/show/{id}', [AdminPenelitianController::class, 'showPenelitian'])->name('admin.show.penelitian');
    Route::put('/admin/penelitian/edit-status/{id}', [AdminPenelitianController::class, 'validatePenelitian'])->name('validasi.penelitian');

    // ===== Kelola Berita (baru ditambahkan) =====
    Route::get('/admin/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news/store', [AdminNewsController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/edit/{id}', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/update/{id}', [AdminNewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/delete/{id}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');

    // ===== Pengguna > Ketua KBK (baru ditambahkan) =====
    Route::get('/admin/ketua-kbk', [AdminKetuaKbkController::class, 'ketuaKBK']);
    Route::get('/admin/k-kbk/show/{id}', [AdminKetuaKbkController::class, 'showDataKetuaKbk'])->name('show.k-kbk');
    Route::post('/admin/ketua-kbk/store', [AdminKetuaKbkController::class, 'storeDataKetuaKbk']);
    Route::post('/admin/ketua-kbk/update/{id}', [AdminKetuaKbkController::class, 'updateKetuaKbk'])->name('update.k-kbk');
    Route::delete('/admin/ketua-kbk/delete/{id}', [AdminKetuaKbkController::class, 'hapusKetuaKbk'])->name('hapus.k-kbk');
    Route::get('/admin/ketua-kbk/reset_password_KKBK/{id}', [AdminKetuaKbkController::class, 'resetPassword'])->name('kkbk.reset.password');
});

// ===== Area Ketua KBK — role disamakan ke 'Ketua KBK' =====
Route::middleware(['auth', 'role:Ketua KBK'])->group(function () {
    Route::get('/k-kbk/dashboard', [KetuaKbkController::class, 'dashboardPage']);

    Route::get('/k-kbk/anggota-kbk', [KetuaKbkController::class, 'anggotaPage']);
    Route::post('/k-kbk/anggota-kbk/store', [KetuaKbkController::class, 'storeAnggota']);
    Route::put('/k-kbk/anggota-kbk/edit/{id}', [KetuaKbkController::class, 'updateAnggota'])->name('edit.anggota');
    Route::delete('/k-kbk/anggota-kbk/hapus/{id}', [KetuaKbkController::class, 'hapusAnggota'])->name('hapus.anggota');

    Route::get('/k-kbk/produk', [KetuaKbkController::class, 'produkInovasi']);
    Route::get('/k-kbk/produk/lihat/{id}', [KetuaKbkController::class, 'showProduk'])->name('lihat.produk');
    Route::post('/k-kbk/produk/store', [KetuaKbkController::class, 'storeProduk']);
    Route::put('/k-kbk/produk/update/{id}', [KetuaKbkController::class, 'updateProdukInovasi'])->name('update.produk');
    Route::delete('/k-kbk/produk/hapus/{id}', [KetuaKbkController::class, 'hapusProduk'])->name('hapus.produk');

    Route::get('/k-kbk/penelitian', [KetuaKbkController::class, 'penelitian']);
    Route::post('/k-kbk/penelitian/store', [KetuaKbkController::class, 'storePenelitian']);
    Route::get('/k-kbk/penelitian/{id}', [KetuaKbkController::class, 'showPenelitian'])->name('show.penelitian');
    Route::put('/k-kbk/penelitian/update/{id}', [KetuaKbkController::class, 'updatePenelitian'])->name('edit.penelitian');
    Route::delete('/k-kbk/penelitian/hapus/{id}', [KetuaKbkController::class, 'hapusPenelitian'])->name('hapus.penelitian');

    Route::get('/k-kbk/profil', [KetuaKbkController::class, 'profil']);
    Route::get('/k-kbk/profil/edit', [KetuaKbkController::class, 'editProfil']);
    Route::put('/k-kbk/profil/update/{id}', [KetuaKbkController::class, 'updateProfil'])->name('update.profil');
    Route::get('/k-kbk/profil/ubah_password/{id}', [KetuaKbkController::class, 'ubahPasswordUser'])->name('ubah.password');
    Route::post('/k-kbk/profil/ubah_password/{id}', [KetuaKbkController::class, 'prosesUbahPassword'])->name('proses.ubah.password');
});