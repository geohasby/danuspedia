<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

require __DIR__.'/auth.php';


Route::resource('order', OrderController::class);

Route::resource('product', ProductController::class);

Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::middleware('auth', 'verified', 'seller')->group(function () {
    Route::get('seller/home', [SellerController::class, 'index'])->name('seller.home');
    Route::put('confirm_order/{confirm_order}', [OrderController::class, 'konfirmasi_penjual'])->name('confirm_order');
    Route::put('cancel_by_seller/{cancel_by_seller}', [OrderController::class, 'cancel_by_seller'])->name('cancel_by_seller');

});

Route::middleware('auth', 'verified', 'customer')->group(function () {
    
    Route::get('{mode}/{keyword?}', [ProductController::class, 'search']); //taruh paling bawah
});

