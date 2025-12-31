<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiDiController;
use App\Http\Controllers\Api\ApiHcController;
use App\Http\Controllers\Api\ApiPatenController;
use App\Http\Controllers\Api\ApiUsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/data/count/paten', [ApiPatenController::class, 'countAllDataPaten']);
// Route::get('/data/count/hak-cipta', [ApiHcController::class, 'countAllDataHc']);
// Route::get('/data/count/desain-industri', [ApiDiController::class, 'countAllDataDi']);
// // Route::prefix('hak-cipta')->group(function () {
//     Route::get('/get/data/{id}', [ApiHcController::class, 'getHcById']);
//     Route::get('/get/data/dosen', [ApiHcController::class, 'getDataDosen']);
//     Route::get('/get/data/umum', [ApiHcController::class, 'getDataUmum']);
// });

// // Route Group untuk API Desain Industri
// Route::prefix('desain-industri')->group(function () {
//     Route::get('/get/data/{id}', [ApiDiController::class, 'getDataById']);
//     Route::get('/get/data/dosen', [ApiDiController::class, 'getDataDosen']);
//     Route::get('/get/data/umum', [ApiDiController::class, 'getDataUmum']);
// });


