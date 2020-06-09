<?php

namespace Submtd\LaravelApiToken\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiToken\Models\ApiToken;
use Submtd\LaravelApiToken\Resources\ApiTokenResource;

class ShowToken extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @param string $uuid
     * @return \Submtd\LaravelApiToken\Resources\ApiTokenResource
     */
    public function __invoke(Request $request, string $uuid)
    {
        if (! $token = ApiToken::where('user_id', Auth::id())->where('uuid', $uuid)->first()) {
            throw new Exception('Unknown token', 404);
        }

        return new ApiTokenResource($token);
    }
}
