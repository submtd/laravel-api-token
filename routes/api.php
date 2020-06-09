<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api/v1/token',
    'middleware' => 'auth:api',
    'namespace' => 'Submtd\LaravelApiToken\Controllers',
], function () {
    Route::get('me', 'Me');
});
