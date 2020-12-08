<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect('login');
});

require __DIR__.'/auth.php';

Route::middleware('auth', 'verified')->group(function() {
    Route::resource('order', OrderController::class);
    Route::resource('product', ProductController::class);
    Route::get('home', [ProductController::class, 'index'])->name('home');
    Route::get('history', [OrderController::class, 'history'])->name('history');
});

Route::middleware('auth', 'verified', 'seller')->group(function () {
    Route::get('seller/home', [OrderController::class, 'seller_index'])->name('seller.home');
    Route::put('confirm_order/{confirm_order}', [OrderController::class, 'konfirmasi_penjual'])->name('confirm_order');
    Route::put('cancel/{cancel}', [OrderController::class, 'cancel'])->name('cancel');
});

Route::middleware('auth', 'verified', 'customer')->group(function () {
    Route::get('{mode}/{keyword?}', [ProductController::class, 'search']); //taruh paling bawah
});

