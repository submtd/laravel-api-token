<?php

namespace Submtd\LaravelApiToken\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Submtd\LaravelApiToken\Facades\ApiTokenFacade;
use Submtd\LaravelApiToken\Resources\ApiTokenResource;

class RefreshToken extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @return \Submtd\LaravelApiToken\Resources\ApiTokenResource
     */
    public function __invoke(Request $request)
    {
        if (! $token = ApiTokenFacade::refresh($request->get('refresh_token'))) {
            throw new Exception('Could not refresh token.', 401);
        }

        return new ApiTokenResource($token);
    }
}
