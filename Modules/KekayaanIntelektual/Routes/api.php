<?php

use Illuminate\Support\Facades\Route;
use Modules\KekayaanIntelektual\app\Http\Controllers\Api\ApiDiController;
use Modules\KekayaanIntelektual\app\Http\Controllers\Api\ApiHcController;
use Modules\KekayaanIntelektual\app\Http\Controllers\Api\ApiPatenController;

/*
|--------------------------------------------------------------------------
| API Routes — Modul Kekayaan Intelektual
|--------------------------------------------------------------------------
| Setelah penggabungan sistem, API ini tidak wajib lagi dipakai internal
| (modul ProdukInovasi bisa query relasi Eloquent langsung ke model
| Paten/HakCipta/DesainIndustri). Tapi tetap dipertahankan untuk
| kemungkinan integrasi pihak ketiga di luar sistem ini nanti.
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
