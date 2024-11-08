<?php
use App\Http\Controllers\PeminjamanController;

Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');

Route::get('/', function () {
    return view('welcome');
});
