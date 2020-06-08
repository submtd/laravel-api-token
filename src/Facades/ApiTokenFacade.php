<?php

namespace Submtd\LaravelApiToken\Facades;

use Illuminate\Support\Facades\Facade;

/*
 * @method static \Submtd\LaravelApiToken\Models\ApiToken create(int $user_id)
 * @method static \Submtd\LaravelApiToken\Models\ApiToken refresh(string $refresh_token)
 * @method static \Submtd\LaravelApiToken\Models\ApiToken destroy(\Submtd\LaravelApiToken\Models\ApiToken $apiToken)
 * @method static void destroyAll(int $user_id)
 * @method static \Submtd\LaravelApiToken\Models\ApiToken find(string $token)
 * @method static string generateToken(int $length)
 *
 * @see \Submtd\LaravelApiToken\Services\ApiTokenService
 */

class ApiTokenFacade extends Facade
{
    /**
     * Get facade accessor.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'api-token-service';
    }
}
