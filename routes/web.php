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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('products', \App\Http\Controllers\ProductController::class)
    ->middleware(['auth'])
    ->except('show');

Route::resource('categories', \App\Http\Controllers\CategoryController::class)
    ->middleware(['auth'])
    ->except('show');

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware(['auth'])
    ->except(['show', 'store', 'create']);

Route::resource('orders', \App\Http\Controllers\AdminOrderController::class)
    ->middleware(['auth'])
    ->except(['store', 'create']);

//Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index'])->middleware(['auth'])->name('product');

require __DIR__.'/auth.php';
