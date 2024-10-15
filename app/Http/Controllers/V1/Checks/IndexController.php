<?php

declare (strict_types = 1);

namespace App\Http\Controllers\V1\Checks;

use App\Http\Resources\V1\CheckResource;
use App\Models\Check;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class IndexController
{
    public function __invoke(): Response
    {
        $checks = Check::query()
            ->simplePaginate(
                config('app.pagination.limit')
            );

        return new JsonResponse(
            data: CheckResource::collection(
                resource: $checks
            ),
        );
    }
}
