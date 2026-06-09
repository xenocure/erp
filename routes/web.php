<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    TransaksiController,
    KategoriController,
    WalletController,
    BudgetController
};

// halaman login
Route::get('/', fn() => view('login'))->name('login');

// proses login
Route::post('/login', [AuthController::class, 'login']);

// logout
Route::get('/logout', [AuthController::class, 'logout']);


// PROTECTED ROUTES
Route::middleware(['authcheck'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // DOWNLOAD PDF
    Route::get('/laporan/pdf', [DashboardController::class, 'downloadPdf']);

    Route::resource('/transaksi', TransaksiController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/wallet', WalletController::class);
    Route::resource('/budget', BudgetController::class);

});