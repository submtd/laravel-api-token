<?php

namespace Submtd\LaravelApiToken\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiToken\Facades\ApiTokenFacade;
use Submtd\LaravelApiToken\Resources\ApiTokenResource;

class LoginForToken extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @return \Submtd\LaravelApiToken\Resources\ApiTokenResource
     */
    public function __invoke(Request $request)
    {
        if (! Auth::attempt($request->all())) {
            throw new Exception('Invalid credentials', 401);
        }
        $token = ApiTokenFacade::create(Auth::id());

        return new ApiTokenResource($token);
    }
}
