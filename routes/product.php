<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::middleware(['role:admin|super-admin'])->group(function () {
   Route::resource('products', \App\Http\Controllers\ProductController::class);
 
});

Route::middleware(['role:admin|super-admin'])->prefix('admin/products')->name('admin.')->group(function () {
    //Route::get('low-stocks', [ProductController::class, 'lowStockProducts'])->name('low-stocks');
    Route::post('restock', [ProductController::class, 'restock'])->name('restock');
});
// Route::get('/product/index', function () {
//     return view('product.index');
// })->name('product-index');

// Route::get('/product/create', function () {
//     return view('product.create_product');
// })->name('product-create');

// Route::get('/product/edit', function () {
//     return view('product.edit_product');
// })->name('product-edit');

