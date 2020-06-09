<?php

namespace Submtd\LaravelApiToken\Providers;

use Carbon\Carbon;
use Illuminate\Auth\EloquentUserProvider;
use Submtd\LaravelApiToken\Models\ApiToken;

class ApiTokenUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (! isset($credentials['api_token'])) {
            return parent::retrieveByCredentials($credentials);
        }
        if (! $apiToken = ApiToken::where('token', hash('sha256', $credentials['api_token']))
            ->where('token_expires_at', '>', Carbon::now())
            ->with('user')
            ->first()) {
            return;
        }
        $apiToken->last_used_at = Carbon::now();
        $apiToken->save();

        return $apiToken->user;
    }
}
