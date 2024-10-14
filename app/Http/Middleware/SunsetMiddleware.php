<?php

declare (strict_types = 1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class SunsetMiddleware
{
    public function handle(Request $request, Closure $next, string $date): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set(
            key: 'Sunset',
            values: $date
        );
        $response->headers->set(
            key: 'Deprecated', 
            values: now()->gte(Carbon::parse($date)) ? 'true' : 'false'
        );

        return $response;
    }
}
