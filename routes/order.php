<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Route::get('/pos-test', [OrderController::class, 'index'])->name('pos.index');
// Route::get('/ordersss', [OrderController::class, 'order'])->name('pos.order');
// Route::get('/pos-orderss', [OrderController::class, 'list_orders'])->name('pos.orders');
Route::middleware(['auth'])->group(function () {
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::post('orders/{order}/process-approval', [OrderController::class, 'processApproval'])->name('orders.process-approval');
    // Route::post('orders/{order}/process-return', [OrderController::class, 'processReturn'])->name('orders.process-return');

    // Admin routes
    // Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('orders', AdminOrderController::class);
            Route::post('orders/{order}/process-approval', [AdminOrderController::class, 'processApproval'])->name('orders.process-approval');
            // Route::post('orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
            // Route::post('orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('orders.reject');
            Route::post('orders/{order}/return', [AdminOrderController::class, 'processReturn'])->name('orders.return');
        });
});

