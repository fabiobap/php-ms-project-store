<?php

use App\Http\Controllers\V1\Public\HomeController;
use App\Http\Controllers\V1\Public\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
