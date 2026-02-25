<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth/google/verify', [AuthController::class, 'verifyGoogle']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/webhooks/xendit', [\App\Http\Controllers\XenditWebhookController::class, 'handle']);
Route::middleware('auth')->group(function () {
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/dashboard', [PosController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/export', [PosController::class, 'exportExcel'])->name('dashboard.export');
        Route::get('/transactions', [PosController::class, 'transactions'])->name('transactions.index');
        Route::get('/setting', [PosController::class, 'setting'])->name('setting');
        Route::post('/setting', [PosController::class, 'updateSetting'])->name('setting.update');
        Route::post('/user', [PosController::class, 'storeUser'])->name('user.store');
        Route::put('/user/{user}', [PosController::class, 'updateUser'])->name('user.update');
        Route::delete('/user/{user}', [PosController::class, 'destroyUser'])->name('user.destroy');
    });

    Route::get('/cashier', [PosController::class, 'cashier'])->name('cashier');
    Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::put('/product/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/category', [\App\Http\Controllers\ProductController::class, 'storeCategory'])->name('category.store');
    Route::delete('/category/{category}', [\App\Http\Controllers\ProductController::class, 'destroyCategory'])->name('category.destroy');
    
    Route::post('/order', [PosController::class, 'storeOrder'])->name('order.store');
    Route::get('/order/{order}/print', [PosController::class, 'printReceipt'])->name('order.print');
    Route::get('/order/{order}/status', [PosController::class, 'checkPaymentStatus'])->name('order.status');
    Route::post('/user', [PosController::class, 'storeUser'])->name('user.store');
    Route::put('/user/{user}', [PosController::class, 'updateUser'])->name('user.update');
    Route::delete('/user/{user}', [PosController::class, 'destroyUser'])->name('user.destroy');
    Route::get('/xendit/success', function() {
        return view('pos.xendit-success');
    })->name('xendit.success');
});