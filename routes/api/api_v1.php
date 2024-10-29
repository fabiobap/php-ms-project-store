<?php

use App\Enums\APITokenTypes;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth:sanctum', 'ability:' . APITokenTypes::ACCESS_TOKEN->getAbility()],
], function () {
    require __DIR__ . '/admin.php';
});

Route::group([
    'as' => 'public.',
], function () {
    require __DIR__ . '/public.php';
});

Route::group([
    'as' => 'auth.',
    'prefix' => 'auth'
], function () {
    require __DIR__ . '/auth.php';
});
