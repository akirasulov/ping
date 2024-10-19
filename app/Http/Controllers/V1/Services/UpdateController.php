<?php

declare (strict_types = 1);

namespace App\Http\Controllers\V1\Services;

use App\Http\Requests\V1\Services\WriteRequest;
use App\Http\Response\V1\MessageResponse;
use App\Jobs\Services\UpdateService;
use App\Models\Service;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final class UpdateController
{
    public function __construct(private readonly Dispatcher $bus)
    {}

    public function __invoke(WriteRequest $request, Service $service): Response | Responsable
    {
        if (!Gate::allows('update', $service)) {
            throw new UnauthorizedException(
                message: __('services.v1.update.failure'),
                code: Response::HTTP_FORBIDDEN,
            );
        }
        // $service->update(
        //     attributes: $request->validated()
        // );

        // return new JsonResponse(
        //     data: new ServiceResource(
        //         resource: $service->refresh(),
        //     ),
        //     status: Response::HTTP_ACCEPTED,
        // );

        $this->bus->dispatch(
            command: new UpdateService(
                payload: $request->payload(),
                service: $service,
            ),
        );

        return new MessageResponse(
            message: __('services.v1.update.failure'),
            status: Response::HTTP_ACCEPTED,
        );
    }
}
