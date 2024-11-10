<?php

use App\Http\Controllers\SportsEquipmentController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;

// Rute untuk halaman utama (menampilkan daftar barang)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk halaman dashboard admin yang menampilkan daftar barang
Route::get('/admin/dashboard', [BarangController::class, 'index'])->name('admin.dashboard');


// Rute CRUD untuk admin (admin dan barang adalah hal terpisah)
Route::resource('admin', AdminController::class);  // Menggunakan resource controller untuk admin

// Rute untuk barang jika dikelola oleh SportsEquipmentController
Route::get('/admin/equipment', [SportsEquipmentController::class, 'adminIndex'])->name('admin.equipment.index'); // Menampilkan daftar barang untuk admin
Route::get('/admin/equipment/create', [SportsEquipmentController::class, 'create'])->name('admin.equipment.create'); // Form tambah barang
Route::post('/admin/equipment/store', [SportsEquipmentController::class, 'store'])->name('admin.equipment.store'); // Simpan barang baru
Route::get('/admin/equipment/{id}/edit', [SportsEquipmentController::class, 'edit'])->name('admin.equipment.edit'); // Form edit barang
Route::put('/admin/equipment/{id}', [SportsEquipmentController::class, 'update'])->name('admin.equipment.update'); // Update barang
Route::delete('/admin/equipment/{id}', [SportsEquipmentController::class, 'destroy'])->name('admin.equipment.destroy'); // Hapus barang

// Rute CRUD untuk barang jika menggunakan BarangController (Opsional jika menggunakan resource)
Route::resource('barang', BarangController::class);  // Jika barang dikelola oleh BarangController

// Rute tambahan untuk stok barang
Route::get('/admin/barang/stok', [BarangController::class, 'showStok'])->name('admin.barang.stok');
Route::post('/admin/barang/update-stok/{id}', [BarangController::class, 'updateStok'])->name('admin.barang.update-stok');

//Route peminjaman dan pengembalian
Route::post('/peminjaman/{barangId}', [PeminjamanController::class, 'storePeminjaman'])->name('peminjaman.store');
Route::post('/pengembalian/{peminjamanId}', [PeminjamanController::class, 'storePengembalian'])->name('pengembalian.store');
