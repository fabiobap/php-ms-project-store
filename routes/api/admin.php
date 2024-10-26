<?php


use App\Http\Controllers\V1\Admin\Users\UserController;
use App\Http\Controllers\V1\Admin\Users\UserCustomerController;
use App\Http\Controllers\V1\Admin\Users\UserAdminController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
], function () {
    Route::get('/user-admins', UserAdminController::class)->name('user-admins');
    Route::get('/user-customers', UserCustomerController::class)->name('user-customers');
    Route::get('/{user:uuid}', [UserController::class, 'show'])->name('show');
    Route::delete('/{user:uuid}', [UserController::class, 'destroy'])->name('destroy');
});
