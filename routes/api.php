<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MasterDataController;
use App\Http\Controllers\Api\LahanController;
use App\Http\Controllers\Api\DataTanamController;
use App\Http\Controllers\Api\DataPanenController;

Route::post('/check-phone', [AuthController::class, 'checkPhoneAvailability']);
Route::post('/login', [AuthController::class, 'loginWithPhone']);

Route::middleware('auth:sanctum')->group(function () {

    // auth & profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'profile']);
    
    // update profile
    Route::patch('/profile', [UserController::class, 'update']);
    Route::patch('/fcm-token', [UserController::class, 'updateFcmToken']);


    // Untuk dropdown menu
    Route::prefix('master')->group(function () {
        Route::get('/komoditas', [MasterDataController::class, 'komoditas']);
        Route::get('/varietas', [MasterDataController::class, 'varietas']);
        Route::get('/kelompok-tani', [MasterDataController::class, 'kelompokTani']);
    });

    // CRUD Lahan
    Route::apiResource('lahan', LahanController::class);

    // List data tanam yang sedang aktif
    Route::get('/tanam/ongoing', [DataTanamController::class, 'showOnGoing']);
    
    // CRUD Data Tanam
    Route::get('/tanam', [DataTanamController::class, 'index']); 
    Route::post('/tanam', [DataTanamController::class, 'store']); 
    Route::get('/tanam/{dataTanam}', [DataTanamController::class, 'show']); 
    Route::patch('/tanam/{dataTanam}', [DataTanamController::class, 'update']); 

    // Lihat Riwayat Panen (List & Detail)
    Route::get('/panen', [DataPanenController::class, 'index']);
    Route::get('/panen/{dataPanen}', [DataPanenController::class, 'show']);
    
    // hasil panen -> input
    Route::post('/panen', [DataPanenController::class, 'store']);
    
    // edit Data Panen (Status akan reset jadi Pending)
    Route::patch('/panen/{dataPanen}', [DataPanenController::class, 'update']);
    
    // verifikasi data melalui button verify
    Route::post('/panen/{dataPanen}/verify', [DataPanenController::class, 'verify']);

});