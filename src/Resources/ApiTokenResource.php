<?php

namespace Submtd\LaravelApiToken\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTokenResource extends JsonResource
{
    /**
     * To array.
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'apiToken',
            'id' => $this->uuid,
            'attributes' => [
                'name' => $this->name,
                'token' => $this->when($this->clear_token, $this->clear_token),
                'token_expires_at' => $this->token_expires_at->toIso8601String(),
                'refresh' => $this->when($this->clear_refresh, $this->clear_refresh),
                'refresh_expires_at' => $this->refresh_expires_at->toIso8601String(),
                'last_used_at' => $this->last_used_at ? $this->last_used_at->toIso8601String() : 'never',
                'created_at' => $this->created_at->toIso8601String(),
            ],
        ];
    }
}
