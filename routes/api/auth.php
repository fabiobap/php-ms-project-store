<?php

use App\Enums\APITokenTypes;
use App\Http\Controllers\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('refresh-token', [AuthController::class, 'refresh'])
        ->name('refresh_token')
        ->middleware('ability:' . APITokenTypes::REFRESH_TOKEN->getAbility());
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('ability:' . APITokenTypes::ACCESS_TOKEN->getAbility());
    Route::get('me', [AuthController::class, 'me'])
        ->name('me')
        ->middleware('ability:' . APITokenTypes::ACCESS_TOKEN->getAbility());
});
