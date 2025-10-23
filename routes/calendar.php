<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

Route::middleware(['auth'])->group(function () {
    Route::get('calendar/orders', [CalendarController::class, 'getOrders'])->name('calendar.orders');
    Route::resource('/calendar', CalendarController::class);
});
// Route::get('/calendar/orderss', [CalendarController::class, 'getOrders'])->name('calendar.orders');
