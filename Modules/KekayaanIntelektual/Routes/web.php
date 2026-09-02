<?php

use Illuminate\Support\Facades\Route;
use Modules\KekayaanIntelektual\app\Http\Controllers\AdminPatenController;
use Modules\KekayaanIntelektual\app\Http\Controllers\AdminHaKCiptaController;
use Modules\KekayaanIntelektual\app\Http\Controllers\AdminDesainIndustriController;
use Modules\KekayaanIntelektual\app\Http\Controllers\AdminJurusanController;
use Modules\KekayaanIntelektual\app\Http\Controllers\AdminProdiController;

/*
|--------------------------------------------------------------------------
| Route Modul Kekayaan Intelektual
|--------------------------------------------------------------------------
| Dipindahkan dari routes/web.php aplikasi inti (Fase 3 penggabungan
| sistem). Dibungkus middleware yang sama persis seperti sebelumnya
| (auth + role:Admin), supaya tidak ada perubahan keamanan.
*/

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/paten', [AdminPatenController::class, 'index'])->middleware('auth');
    Route::get('/admin/paten/pemeriksaan-formalitas', [AdminPatenController::class, 'pemeriksaanFormalitas']);
    Route::get('/admin/paten/menunggu-tanggapan-formalitas', [AdminPatenController::class, 'menungguTanggapan']);
    Route::get('/admin/paten/masa-pengumuman', [AdminPatenController::class, 'masaPengumuman']);
    Route::get('/admin/paten/menunggu-pembayaran-substansif', [AdminPatenController::class, 'pembayaranSubstansif']);
    Route::get('/admin/paten/substansif-tahap-awal', [AdminPatenController::class, 'substansifAwal']);
    Route::get('/admin/paten/substansif-tahap-lanjut', [AdminPatenController::class, 'substansifLanjut']);
    Route::get('/admin/paten/substansif-tahap-akhir', [AdminPatenController::class, 'substansifAkhir']);
    Route::get('/admin/paten/menunggu-tanggapan-substansif', [AdminPatenController::class, 'mengungguTanggapanSubstansif']);
    Route::get('/admin/paten/mvdov', [AdminPatenController::class, 'mvdov']);
    Route::get('/admin/paten/diberi', [AdminPatenController::class, 'diberi']);
    Route::get('/admin/paten/ditolak', [AdminPatenController::class, 'ditolak']);
    Route::get('/admin/paten/cari', [AdminPatenController::class, 'caripaten'])->name('admin.paten.cari');
    Route::get('/admin/paten/delete/{id}', [AdminPatenController::class, 'destroy'])->name('admin_paten.delete');
    Route::get('/admin/paten/edit/{id}', [AdminPatenController::class, 'edit'])->name('admin_paten.edit');
    Route::post('/admin/paten/update-data/{id}', [AdminPatenController::class, 'updateData'])->name('adm.update-data-paten');
    Route::post('/admin/paten/umum/update/{id}', [AdminPatenController::class, 'updateDataUmum'])->name('adm.updatepaten.umum');
    Route::post('/admin/paten/update/{id}', [AdminPatenController::class, 'update'])->name('admin_paten.update');
    Route::get('/admin/paten/show/{id}', [AdminPatenController::class, 'show'])->name('admin_paten.show');
    Route::get('/admin/paten/kirim-ke-dashboard/{id}', [AdminPatenController::class, 'formKirimKeDashboard'])->name('admin_paten.form_kirim');
    Route::post('/admin/paten/kirim-ke-dashboard/{id}', [AdminPatenController::class, 'kirimKeDashboard'])->name('admin_paten.kirim');
    Route::get('/paten/{file}', [AdminPatenController::class, 'viewSensitifFilesPaten']);
    Route::get('public/paten/{file}', [AdminPatenController::class, 'viewPublicFilesPaten']);
    Route::get('/desain-industri/{file}', [AdminDesainIndustriController::class, 'viewSensitifFilesDi'])->middleware(['auth', 'role:Admin'])->name('private_di');
    Route::get('/public/desain-industri/{file}', [AdminDesainIndustriController::class, 'viewPublicFilesDi'])->middleware(['auth', 'role:Admin'])->name('public_di');
    Route::get('/sertifikat-paten/{file}', [AdminPatenController::class, 'viewFilesPaten'])->middleware(['auth', 'role:Admin'])->name('public_paten');
    Route::get('/admin/paten/tambah/dosen/', [AdminPatenController::class, 'tambahPatenDosen'])->name('admin_paten.tambah');
    Route::post('/admin/paten/tambah/dosen/store/', [AdminPatenController::class, 'storeTambahPatenDosen'])->name('admin_paten.store');
    Route::get('admin/paten/tambah/umum/', [AdminPatenController::class, 'tambahPatenUmum'])->name('admin_paten.tambah_umum');
    Route::post('/admin/paten/tambah/umum/store/', [AdminPatenController::class, 'storeTambahPatenUmum'])->name('admin_paten.store_umum');
    Route::get('/admin/jurusan', [AdminJurusanController::class, 'index'])->name('admin_jurusan.index');
    Route::post('/admin/jurusan', [AdminJurusanController::class, 'store'])->name('admin_jurusan.store');
    Route::put('/admin/jurusan/{id}', [AdminJurusanController::class, 'update'])->name('admin_jurusan.update');
    Route::delete('/admin/jurusan/{id}', [AdminJurusanController::class, 'destroy'])->name('admin_jurusan.delete');
    Route::get('/admin/prodi', [AdminProdiController::class, 'index'])->name('admin_prodi.index');
    Route::post('/admin/prodi', [AdminProdiController::class, 'store'])->name('admin_prodi.store');
    Route::put('/admin/prodi/{id}', [AdminProdiController::class, 'update'])->name('admin_prodi.update');
    Route::delete('/admin/prodi/{id}', [AdminProdiController::class, 'destroy'])->name('admin_prodi.delete');
    Route::get("/admin/hak-cipta", [AdminHaKCiptaController::class, 'index']);
    Route::get('/admin/hak-cipta/delete/{id}', [AdminHaKCiptaController::class, 'destroy'])->name('admin_hakcipta.delete');
    Route::get('/admin/hak-cipta/edit/{id}', [AdminHaKCiptaController::class, 'edit'])->name('admin_hakcipta.edit');
    Route::post('/admin/hak-cipta/dosen/update/{id}', [AdminHaKCiptaController::class, 'updateHcDosen'])->name('admin_hakcipta.update_dosen');
    Route::post('/admin/hak-cipta/umum/update/{id}', [AdminHaKCiptaController::class, 'updateHcUmum'])->name('admin_hakcipta.update_umum');
    Route::post('/admin/hak-cipta/update/{id}', [AdminHaKCiptaController::class, 'update'])->name('admin_hakcipta.update');
    Route::get('/admin/hak-cipta/show/{id}', [AdminHaKCiptaController::class, 'show'])->name('admin_hakcipta.show');
    Route::get('/admin/hak-cipta/kirim-ke-dashboard/{id}', [AdminHaKCiptaController::class, 'formKirimKeDashboard'])->name('admin_hakcipta.form_kirim');
    Route::post('/admin/hak-cipta/kirim-ke-dashboard/{id}', [AdminHaKCiptaController::class, 'kirimKeDashboard'])->name('admin_hakcipta.kirim');
    Route::get('/admin/hak-cipta/tercatat', [AdminHaKCiptaController::class, 'listTercatat']);
    Route::get('/admin/hak-cipta/ditolak', [AdminHaKCiptaController::class, 'tolak']);
    Route::get('/admin/hak-cipta/keterangan-belum-lengkap', [AdminHaKCiptaController::class, 'belumLengkap']);
    Route::get('/admin/hak-cipta/mvdov', [AdminHaKCiptaController::class, 'mvdov']);
    Route::get('/admin/hak-cipta/cari', [AdminHaKCiptaController::class, 'cariHk']);
    Route::get('/admin/hak-cipta/tambah/dosen/', [AdminHaKCiptaController::class, 'tambahDosen']);
    Route::post('/admin/hak-cipta/tambah/dosen/store', [AdminHaKCiptaController::class, 'storeTambahHCDosen'])->name('hc.dosen.store');
    Route::get('/admin/hak-cipta/tambah/umum/', [AdminHaKCiptaController::class, 'tambahHcUmum']);
    Route::post('/admin/hak-cipta/tambah/umum/store', [AdminHaKCiptaController::class, 'storeTambahHcUmum'])->name('admin.tambahhc.umum');
    Route::get('/admin/desain-industri', [AdminDesainIndustriController::class, 'index']);
    Route::get('/admin/desain-industri/diberi', [AdminDesainIndustriController::class, 'diberi']);
    Route::get('/admin/desain-industri/dalam-proses-usulan', [AdminDesainIndustriController::class, 'proses']);
    Route::get('/admin/desain-industri/pemeriksaan', [AdminDesainIndustriController::class, 'pemeriksaan']);
    Route::get('/admin/desain-industri/ditolak', [AdminDesainIndustriController::class, 'ditolak']);
    Route::get('/admin/desain-industri/keterangan-belum-lengkap', [AdminDesainIndustriController::class, 'keteranganBelumLengkap']);
    Route::get('/admin/desain-industri/delete/{id}', [AdminDesainIndustriController::class, 'destroy'])->name('admin_desainindustri.delete');
    Route::get('/admin/desain_industri/edit/{id}', [AdminDesainIndustriController::class, 'edit'])->name('admin_desainindustri.edit');
    Route::post('/admin/desain-industri/dosen/update/{id}', [AdminDesainIndustriController::class, 'updateDiDosen'])->name('adm.update-di.dosen');
    Route::post('/admin/desain-industri/umum/update/{id}', [AdminDesainIndustriController::class, 'upateDiUmum'])->name('adm.update-di.umum');
    Route::post('/admin/desain-industri/update/{id}', [AdminDesainIndustriController::class, 'update'])->name('admin_desainindustri.update');
    Route::get('/admin/desain-industri/show/{id}', [AdminDesainIndustriController::class, 'show'])->name('admin_desainindustri.show');
    Route::get('/admin/desain-industri/kirim-ke-dashboard/{id}', [AdminDesainIndustriController::class, 'formKirimKeDashboard'])->name('admin_desainindustri.form_kirim');
    Route::post('/admin/desain-industri/kirim-ke-dashboard/{id}', [AdminDesainIndustriController::class, 'kirimKeDashboard'])->name('admin_desainindustri.kirim');
    Route::get('/admin/desain-industri/cari', [AdminDesainIndustriController::class, 'cariDI']);
    Route::get('/admin/desain-industri/tambah/dosen/', [AdminDesainIndustriController::class, 'tambahDiDosen']);
    Route::post('/admin/desain-industri/tambah/dosen/store', [AdminDesainIndustriController::class, 'storeDiDosen']);
    Route::get('/admin/desain-industri/tambah/umum/', [AdminDesainIndustriController::class, 'tambahDiUmum']);
    route::post('/admin/desain-industri/tambah/umum/store', [AdminDesainIndustriController::class, 'storeDiUmum']);
});