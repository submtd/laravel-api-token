<?php

namespace Submtd\LaravelApiToken\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * To array.
     */
    public function toArray(Request $request)
    {
        return [
            'type' => 'user',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
            ],
        ];
    }
}
