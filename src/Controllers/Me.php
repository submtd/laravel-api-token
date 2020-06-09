<?php

namespace Submtd\LaravelApiToken\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiToken\Resources\UserResource;

class Me extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @return \Submtd\LaravelApiToken\Resources\User
     */
    public function __invoke(Request $request)
    {
        return new UserResource(Auth::user());
    }
}
