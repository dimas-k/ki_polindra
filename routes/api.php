<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiDiController;
use App\Http\Controllers\Api\ApiHcController;
use App\Http\Controllers\Api\ApiPatenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API publik read-only untuk data karya intelektual yang sudah "Diberi"
| (granted). Dipakai sistem lain (misal Dashboard Produk Inovasi Polindra)
| untuk menampilkan statistik/daftar tanpa akses langsung ke database SIKI.
| Tidak butuh autentikasi karena hanya mengembalikan data non-sensitif
| (tanpa KTP, alamat, kontak pribadi pengaju).
|
*/

Route::prefix('paten')->group(function () {
    Route::get('/count', [ApiPatenController::class, 'countAllDataPaten']);
    Route::get('/diberi', [ApiPatenController::class, 'getDataDiberi']);
});

Route::prefix('hak-cipta')->group(function () {
    Route::get('/count', [ApiHcController::class, 'countAllDataHc']);
    Route::get('/diberi', [ApiHcController::class, 'getDataDiberi']);
});

Route::prefix('desain-industri')->group(function () {
    Route::get('/count', [ApiDiController::class, 'countAllDataDi']);
    Route::get('/diberi', [ApiDiController::class, 'getDataDiberi']);
});
