<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DanusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('/home', [ProductController::class, 'index'])->middleware('auth', 'verified')->name('home');

require __DIR__.'/auth.php';

Route::resource('danus', DanusController::class);

Route::resource('product', ProductController::class);

Route::resource('order', OrderController::class);


