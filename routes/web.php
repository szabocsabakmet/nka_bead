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


Route::get('/', [\App\Http\Controllers\MainPageController::class, 'mainPage']);

Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ShipmentController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::resource('categories', \App\Http\Controllers\CategoryController::class)
        ->middleware(['auth'])
        ->except('show');

    Route::resource('users', \App\Http\Controllers\UserController::class)
        ->middleware(['auth'])
        ->except(['show', 'store', 'create']);

    Route::resource('orders', \App\Http\Controllers\AdminOrderController::class)
        ->middleware(['auth'])
        ->except(['store', 'create']);



});

Route::get('/userorders', [\App\Http\Controllers\OrderController::class, 'index'])->middleware(['auth'])->name('userorders');
Route::get('/userorders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->middleware(['auth'])->name('userorders_show');
Route::resource('products', \App\Http\Controllers\ProductController::class)
    ->middleware(['auth'])
    ->except('show');

Route::get('/buy', [\App\Http\Controllers\ProductController::class, 'buyIndex'])->middleware(['auth'])->name('buy_index');
Route::post('/buy', [\App\Http\Controllers\ProductController::class, 'buy'])->middleware(['auth'])->name('buy');


//Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index'])->middleware(['auth'])->name('product');

require __DIR__.'/auth.php';
