<?php

namespace Submtd\LaravelApiToken\Services;

use Carbon\Carbon;
use Submtd\LaravelApiToken\Models\ApiToken;

class ApiTokenService
{
    /**
     * Create token.
     * @param int $user_id
     * @return \Submtd\LaravelApiToken\Models\ApiToken
     */
    public function create(int $user_id) : ApiToken
    {
        $token = $this->generateToken(config('api-token.token_length', 128));
        $refresh = $this->generateToken(config('api-token.refresh_length', 256));
        $apiToken = ApiToken::create([
            'user_id' => $user_id,
            'token' => hash('sha256', $token),
            'token_expires_at' => Carbon::now()->addMinutes(config('api-token.token_expiration_minutes', 1440)),
            'refresh' => hash('sha256', $refresh),
            'refresh_expires_at' => Carbon::now()->addMinutes(config('api-token.refresh_expiration_minutes', 10080)),
        ]);
        $apiToken->clear_token = $token;
        $apiToken->clear_refresh = $refresh;

        return $apiToken;
    }

    /**
     * Refresh token.
     * @param string $refresh_token
     * @return \Submtd\LaravelApiToken\Models\ApiToken
     */
    public function refresh(string $refresh_token) : ApiToken
    {
        if (! $apiToken = ApiToken::where('refresh', hash('sha256', $refresh_token))->where('refresh_expires_at', '>', Carbon::now())->first()) {
            throw new Exception('Invalid refresh token', 404);
        }
        $token = $this->generateToken(config('api-token.authentication_token_length', 128));
        $refresh = $this->generateToken(config('api-token.refresh_length', 256));
        $apiToken->update([
            'token' =>hash('sha256', $token),
            'token_expires_at' => Carbon::now()->addMinutes(config('api-token.token_expiration_minutes', 1440)),
            'refresh' =>hash('sha256', $refresh),
            'refresh_expires_at' => Carbon::now()->addMinutes(config('api-token.refresh_expiration_minutes', 10080)),
        ]);
        $apiToken->clear_token = $token;
        $apiToken->clear_refresh = $refresh;

        return $apiToken;
    }

    /**
     * Destroy token.
     * @param \Submtd\LaravelApiToken\Models\ApiToken $apiToken
     * @return \Submtd\LaravelApiToken\Models\ApiToken
     */
    public function destroy(ApiToken $apiToken) : ApiToken
    {
        $apiToken->update([
            'token_expires_at' => Carbon::now(),
            'refresh_expires_at' => Carbon::now(),
        ]);

        return $apiToken;
    }

    /**
     * Destroy all tokens for user.
     * @param int $user_id
     * @return void
     */
    public function destroyAll(int $user_id)
    {
        ApiToken::where('user_id', $user_id)->update([
            'token_expires_at' => Carbon::now(),
            'refresh_expires_at' => Carbon::now(),
        ]);
    }

    /**
     * Find a token.
     * @param string $token
     * @return \Submtd\LaravelApiToken\Models\ApiToken
     */
    public function find(string $token) : ApiToken
    {
        if (! $apiToken = ApiToken::where('token', hash('sha256', $token))->where('token_expires_at', '>', Carbon::now())->first()) {
            throw new Exception('Invalid authentication token', 404);
        }

        return $apiToken;
    }

    /**
     * Generate a random token.
     * @param int $length
     * @return string
     */
    public function generateToken(int $length)
    {
        return bin2hex(openssl_random_pseudo_bytes(floor($length / 2)));
    }
}
