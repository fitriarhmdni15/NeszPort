<?php

use App\Http\Controllers\SiswaController;
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
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/data-siswa', [AdminController::class, 'dataSiswa'])->name('admin.data_siswa');
        Route::get('/data-barang', [AdminController::class, 'dataBarang'])->name('admin.data_barang');
        Route::get('/data-admin', [AdminController::class, 'dataAdmin'])->name('admin.data_admin');

        // Bagian data peminjaman
        Route::get('/data-peminjam', [AdminController::class, 'dataPeminjam'])->name('admin.data_peminjam');
        Route::get('peminjaman/{peminjaman}', [AdminController::class, 'show'])->name('admin.peminjaman.detail');
        Route::post('/pengembalian/{peminjamanId}/approve', [AdminController::class, 'approvePengembalian'])->name('pengembalian.approve');

        // Admin CRUD
        Route::resource('admin', AdminController::class);

        // CRUD Barang alternatif
        Route::resource('barang', BarangController::class);

        // CRUD Siswa
        Route::resource('siswa', SiswaController::class);

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


// Rute logout
Route::get('/logout', function () {
    if (auth()->check()) {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    return redirect('/'); // Redirect ke halaman utama
})->name('logout.get');