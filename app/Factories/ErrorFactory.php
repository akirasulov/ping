<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use JustSteveKing\Tools\Http\Enums\Status;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;
use Treblle\ApiResponses\Data\ApiError;
use Treblle\ApiResponses\Responses\ErrorResponse;

final class ErrorFactory
{
    public static function create(Throwable $exception, Request $request): ErrorResponse
    {
        return match ($exception::class) {
            NotFoundHttpException::class,
            ModelNotFoundException::class => new ErrorResponse(
                data: new ApiError(
                    title: 'Resource not found',
                    detail: 'The resource you requested could not be found',
                    instance: $request->fullUrl(),
                    code: '404',
                    link: 'https://docs.com',
                ),
                status: Status::NOT_FOUND,
            ),
            MethodNotAllowedHttpException::class,
            MethodNotAllowedException::class => new ErrorResponse(
                data: new ApiError(
                    title: 'Method not allowed',
                    detail: "You are trying to do a {$request->getMethod()} request on {$request->url()} that allows {$exception->getAllowedMethods()}.",
                    instance: $request->fullUrl(),
                    code: '405',
                    link: 'https://docs.com',
                ),
                status: Status::NOT_FOUND,
            ),
            default => new ErrorResponse(
                data: new ApiError(
                    title: $exception::class,
                    detail: 'Internal Server Error',
                    instance: $request->fullUrl(),
                    code: '500',
                    link: 'https://docs.com',
                ),
                status: Status::INTERNAL_SERVER_ERROR,
            ),
        };
    }
}
