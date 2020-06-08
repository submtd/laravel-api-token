<?php

namespace Submtd\LaravelApiToken\Providers;

use Illuminate\Support\ServiceProvider;
use Submtd\LaravelApiToken\Services\ApiTokenService;

class LaravelApiTokenServiceProvider extends ServiceProvider
{
    /**
     * Register method.
     */
    public function register()
    {
        // Token facade
        $this->app->bind('api-token-service', function () {
            return new ApiTokenService();
        });
    }

    /**
     * Boot method.
     */
    public function boot()
    {
        // config
        $this->mergeConfigFrom(__DIR__.'/../../config/laravel-api-token.php', 'laravel-api-token');
        $this->publishes([__DIR__.'/../../config' => config_path()], 'config');
        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([__DIR__.'/../../database' => database_path()], 'migrations');
        // routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }
}
