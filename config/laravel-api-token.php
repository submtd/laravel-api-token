<?php

return [
    /*
     * Length for new api tokens.
     */
    'token_length' => env('API_TOKEN_LENGTH', 128),

    /*
     * Length for new refresh tokens.
     */
    'refresh_length' => env('API_REFRESH_LENGTH', 256),

    /*
     * Minutes before tokens expire.
     */
    'token_expiration_minutes' => env('API_TOKEN_EXPIRATION_MINUTES', 1440),

    /*
     * Minutes before refresh tokens expire.
     */
    'refresh_expiration_minutes' => env('API_REFRESH_EXPIRATION_MINUTES', 10080),

    /*
     * User model.
     */
    'user_model' => env('API_USER_MODEL', '\App\User'),
];
