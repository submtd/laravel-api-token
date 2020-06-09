<?php

namespace Submtd\LaravelApiToken\Commands;

use Illuminate\Console\Command;
use Submtd\LaravelApiToken\Facades\ApiTokenFacade;

class MakeToken extends Command
{
    /**
     * Signature.
     * @var string
     */
    protected $signature = 'make:token {user_id?} {name?}';

    /**
     * Description.
     * @var string
     */
    protected $description = 'Create an API token.';

    /**
     * Handle.
     */
    public function handle()
    {
        $user_id = $this->argument('user_id') ?? $this->ask('Enter the user id');
        $name = $this->argument('name') ?? $this->ask('Enter the token name');
        $token = ApiTokenFacade::create($user_id, $name);
        $this->table(null, [
            ['Id', $token->uuid],
            ['Name', $token->name],
            ['Token', $token->clear_token],
            ['Token Expires At', $token->token_expires_at->toIso8601String()],
            ['Refresh', $token->clear_refresh],
            ['Refresh Expires At', $token->refresh_expires_at->toIso8601String()],
        ]);
    }
}
