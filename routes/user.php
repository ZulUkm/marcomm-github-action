<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::resource('users', UserController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});
