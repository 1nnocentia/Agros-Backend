<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MasterDataController;
use App\Http\Controllers\Api\LahanController;
use App\Http\Controllers\Api\DataTanamController;
use App\Http\Controllers\Api\DataPanenController;

Route::post('/login', [AuthController::class, 'loginWithPhone']);

Route::middleware('auth:sanctum')->group(function () {

    // auth & profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'profile']);
    
    // update profile
    Route::post('/profile', [UserController::class, 'update']);
    Route::post('/fcm-token', [UserController::class, 'updateFcmToken']);


    // Untuk dropdown menu
    Route::prefix('master')->group(function () {
        Route::get('/komoditas', [MasterDataController::class, 'komoditas']);
        Route::get('/varietas', [MasterDataController::class, 'varietas']);
        Route::get('/kelompok-tani', [MasterDataController::class, 'kelompokTani']);
    });

    // CRUD Lahan
    Route::apiResource('lahan', LahanController::class);

    // data tanam = status tanam = aktif
    Route::get('/tanam/{dataTanam}/ongoing', [DataTanamController::class, 'showOnGoing']);
    
    // CRUD Data Tanam
    Route::apiResource('tanam', DataTanamController::class);

    // Lihat Riwayat Panen (List & Detail)
    Route::get('/tanam', [DataPanenController::class, 'index']);
    Route::get('/tanam/{dataTanam}', [DataPanenController::class, 'show']);

    // hasil panen -> input
    Route::post('/panen', [DataPanenController::class, 'store']);
    
    // edit Data Panen (Status akan reset jadi Pending)
    Route::put('/panen/{dataPanen}', [DataPanenController::class, 'update']);
    
    // verifikasi data melalui button verify
    Route::post('/panen/{dataPanen}/verify', [DataPanenController::class, 'verify']);
    
    // Lihat Riwayat Panen (List & Detail)
    Route::get('/panen', [DataPanenController::class, 'index']);
    Route::get('/panen/{dataPanen}', [DataPanenController::class, 'show']);

});