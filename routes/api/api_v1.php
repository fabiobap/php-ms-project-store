<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    require __DIR__ . '/admin.php';
});

Route::group([
    'as' => 'admin.',
], function () {
require __DIR__ . '/public.php';
});
