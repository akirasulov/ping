<?php

declare (strict_types = 1);

namespace App\Http\Controllers\V1\Services;

use App\Http\Requests\V1\Services\WriteRequest;
use App\Http\Response\V1\MessageResponse;
use App\Jobs\Services\CreateNewService;
use App\Models\Service;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final class StoreController
{
    public function __construct(private readonly Dispatcher $bus)
    {}

    public function __invoke(WriteRequest $request): Response | Responsable
    {
        if (!Gate::allows('create', Service::class)) {
            throw new UnauthorizedException(
                message: 'Your are not authorized to create a service.',
                code: Response::HTTP_FORBIDDEN,
            );
        }
        // $service = Service::create(array_merge(
        //     $request->validated(),
        //     [
        //         'user_id' => auth()->id(),
        //     ],
        // ));

        // return new JsonResponse(
        //     data: ServiceResource::make(
        //         resource: $service
        //     ),
        //     status: Response::HTTP_CREATED,
        // );

        $this->bus->dispatch(
            command: new CreateNewService(
                payload: $request->payload(),
            ),
        );

        return new MessageResponse(
            message: 'Your service will be created in the background.',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
