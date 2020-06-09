<?php

namespace Submtd\LaravelApiToken\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiToken\Models\ApiToken;
use Submtd\LaravelApiToken\Resources\ApiTokenCollection;

class ListTokens extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @return \Submtd\LaravelApiToken\Resources\ApiTokenResource
     */
    public function __invoke(Request $request)
    {
        $tokens = ApiToken::where('user_id', Auth::id())->orderBy('last_used_at', 'desc')->get();

        return new ApiTokenCollection($tokens);
    }
}
