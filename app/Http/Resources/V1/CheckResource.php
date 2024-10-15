<?php

namespace App\Http\Resources\V1;

use App\Models\Check;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property Check $resource
 */
final class CheckResource extends JsonApiResource
{
    /** @return array<string, mixed> */
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'path' => $this->resource->path,
        ];
    }
}
