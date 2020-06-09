<?php

namespace Submtd\LaravelApiToken\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiTokenCollection extends ResourceCollection
{
    /**
     * To array.
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ApiTokenResource::collection($this->collection),
        ];
    }
}
