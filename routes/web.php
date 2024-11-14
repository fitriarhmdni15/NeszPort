<?php

use App\Http\Controllers\SportsEquipmentController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AuthController;

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {

    // Rute yang hanya dapat diakses oleh admin
    Route::middleware(['can:isAdmin'])->group(function() {
        // Dashboard Admin
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Admin CRUD
        Route::resource('admin', AdminController::class);
        // CRUD Barang alternatif
        Route::resource('barang', BarangController::class);

        // Update stok barang
        Route::get('/admin/barang/stok', [BarangController::class, 'showStok'])->name('admin.barang.stok');
        Route::post('/admin/barang/update-stok/{id}', [BarangController::class, 'updateStok'])->name('admin.barang.update-stok');
    });

    // Rute lainnya yang membutuhkan role 'admin' bisa ditambahkan di sini
});

// Rute yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    Route::middleware(['can:isUser'])->group(function() {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    });

    // Rute lainnya untuk semua user (misalnya peminjaman, pengembalian)
    Route::post('/peminjaman/{barangId}', [PeminjamanController::class, 'storePeminjaman'])->name('peminjaman.store');
    Route::get('/history', [PeminjamanController::class, 'history'])->name('peminjaman.history');
    Route::post('/pengembalian/{peminjamanId}', [PeminjamanController::class, 'storePengembalian'])->name('pengembalian.store');
});
