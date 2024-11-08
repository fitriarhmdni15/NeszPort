<?php

use App\Http\Controllers\SportsEquipmentController;

// Rute untuk halaman utama (menampilkan daftar barang)
Route::get('/', [SportsEquipmentController::class, 'index'])->name('equipment.index');

// Rute CRUD untuk admin
Route::get('/admin/equipment', [SportsEquipmentController::class, 'adminIndex'])->name('admin.equipment.index'); // Menampilkan daftar barang untuk admin
Route::get('/admin/equipment/create', [SportsEquipmentController::class, 'create'])->name('admin.equipment.create'); // Form tambah barang
Route::post('/admin/equipment/store', [SportsEquipmentController::class, 'store'])->name('admin.equipment.store'); // Simpan barang baru
Route::get('/admin/equipment/{id}/edit', [SportsEquipmentController::class, 'edit'])->name('admin.equipment.edit'); // Form edit barang
Route::put('/admin/equipment/{id}', [SportsEquipmentController::class, 'update'])->name('admin.equipment.update'); // Update barang
Route::delete('/admin/equipment/{id}', [SportsEquipmentController::class, 'destroy'])->name('admin.equipment.destroy'); // Hapus barang
