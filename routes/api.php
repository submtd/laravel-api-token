<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api/v1/token',
    'namespace' => 'Submtd\LaravelApiToken\Controllers',
], function () {
    /*
     * Public routes
     */
    Route::post('login', 'LoginForToken');
    Route::post('refresh', 'RefreshToken');
    /*
     * Protected routes
     */
    Route::group([
        'middleware' => [
            'api',
            'auth:api',
        ],
    ], function () {
        Route::get('/', 'ListTokens');
        Route::post('create', 'CreateToken');
        Route::get('{uuid}', 'ShowToken');
        Route::delete('{uuid}', 'DestroyToken');
    });
});
