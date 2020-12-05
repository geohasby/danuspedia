<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\SellerController;
Route::get('seller/home', [SellerController::class, 'index'])->name('seller.home');

use App\Http\Controllers\OrderController;
Route::resource('order', OrderController::class);

use App\Http\Controllers\ProductController;
Route::get('/home', [ProductController::class, 'index'])->middleware('auth', 'verified')->name('home');
Route::resource('product', ProductController::class);
Route::get('{mode}/{keyword?}', [ProductController::class, 'search']); //taruh paling bawah



