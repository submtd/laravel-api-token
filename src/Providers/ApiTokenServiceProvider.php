<?php

namespace Submtd\LaravelApiToken\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Submtd\LaravelApiToken\Commands\MakeToken;
use Submtd\LaravelApiToken\Services\ApiTokenService;

class ApiTokenServiceProvider extends ServiceProvider
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
        // commands
        $this->commands([
            MakeToken::class,
        ]);
    }

    /**
     * Boot method.
     */
    public function boot()
    {
        Auth::provider('eloquent', function ($app, $config) {
            return new ApiTokenUserProvider($app['hash'], $config['model']);
        });
        // config
        $this->mergeConfigFrom(__DIR__.'/../../config/api-token.php', 'api-token');
        $this->publishes([__DIR__.'/../../config' => config_path()], 'config');
        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([__DIR__.'/../../database' => database_path()], 'migrations');
        // routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }
}
