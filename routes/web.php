<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    TransaksiController,
    KategoriController,
    WalletController
};

// halaman login
Route::get('/', fn() => view('login'))->name('login');

// proses login
Route::post('/login', [AuthController::class, 'login']);

// logout (WAJIB ADA)
Route::get('/logout', [AuthController::class, 'logout']);


// PROTECTED ROUTES
Route::middleware(['authcheck'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/transaksi', TransaksiController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/wallet', WalletController::class);

});