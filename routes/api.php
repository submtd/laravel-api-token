<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api/v1/token',
    'middleware' => 'api',
    'namespace' => 'Submtd\LaravelApiToken\Controllers',
], function () {
    /*
     * Public routes
     */
    Route::post('login', 'LoginForToken')->name('api-token.login');
    Route::post('refresh', 'RefreshToken')->name('api-token.refresh');
    /*
     * Protected routes
     */
    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('/', 'ListTokens')->name('api-token.list');
        Route::post('create', 'CreateToken')->name('api-token.create');
        Route::get('{uuid}', 'ShowToken')->name('api-token.show');
        Route::delete('{uuid}', 'DestroyToken')->name('api-token.destroy');
    });
});
