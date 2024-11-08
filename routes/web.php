<?php

use App\Http\Controllers\SportsEquipmentController;

Route::resource('equipment', SportsEquipmentController::class)->except(['show']);
Route::get('equipment/{id}/book', [SportsEquipmentController::class, 'book'])->name('equipment.book');
Route::post('equipment/{id}/book', [SportsEquipmentController::class, 'storeBooking'])->name('equipment.storeBooking');
