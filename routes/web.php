<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth/google/verify', [AuthController::class, 'verifyGoogle']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PosController::class, 'dashboard'])->name('dashboard');
    Route::get('/cashier', [PosController::class, 'cashier'])->name('cashier');
    Route::get('/product', [PosController::class, 'product'])->name('product');
    Route::get('/setting', [PosController::class, 'setting'])->name('setting');
});