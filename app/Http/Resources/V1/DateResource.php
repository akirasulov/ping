<?php

namespace App\Http\Resources\V1;

use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property CarbonInterface $resource
 */
final class DateResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'human' => $this->resource->diffForHumans(),
            'string' => $this->resource->toIso8601String(),
            'local' => $this->resource->toDateTimeString(),
            'timestamp' => $this->resource->timestamp,
        ];
    }
}
