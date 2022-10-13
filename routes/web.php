<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product:slug}', [ProductController::class, 'index'])->name('product');

// Admin

Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.product');
Route::get('/admin/products/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');