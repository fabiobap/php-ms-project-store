<?php

use App\Enums\APITokenTypes;
use App\Http\Controllers\V1\Public\HomeController;
use App\Http\Controllers\V1\Public\PaymentController;
use App\Http\Controllers\V1\Public\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::post('/payment/checkout', [PaymentController::class, 'order'])
    ->middleware([
        'auth:sanctum',
        'ability:' . APITokenTypes::ACCESS_TOKEN->getAbility(),
        'customer'
    ])
    ->name('products.buy');
