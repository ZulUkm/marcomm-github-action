<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
//     Route::resource('dashboard',  [AdminDashboardController::class, 'index'])->name('dashboard');
// });

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // If you need other dashboard actions:
    // Route::resource('dashboard', AdminDashboardController::class);
});