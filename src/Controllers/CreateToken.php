<?php

namespace Submtd\LaravelApiToken\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiToken\Facades\ApiTokenFacade;
use Submtd\LaravelApiToken\Resources\ApiTokenResource;

class CreateToken extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @return \Submtd\LaravelApiToken\Resources\ApiTokenResource
     */
    public function __invoke(Request $request)
    {
        $token = ApiTokenFacade::create(Auth::id(), $request->get('name'));

        return new ApiTokenResource($token);
    }
}
