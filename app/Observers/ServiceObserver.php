<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\CacheKey;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

final class ServiceObserver
{
    public function created(Service $service): void
    {
        $this->forgetServicesForUser(
            userId: $service->user_id,
        );
    }

    public function updated(Service $service): void
    {
        $this->forgetServicesForUser(
            userId: $service->user_id,
        );

        $this->forgetService(
            ulid: $service->id,
        );
    }

    public function deleted(Service $service): void
    {
        $this->forgetServicesForUser(
            userId: $service->user_id,
        );

        $this->forgetService(
            ulid: $service->id,
        );
    }

    private function forgetServicesForUser(string $userId): void
    {
        Cache::forget(
            key: CacheKey::User_services->value . '_' . $userId,
        );
    }

    private function forgetService(string $ulid): void
    {
        Cache::forget(
            key: CacheKey::Service->value . '_' . $ulid,
        );
    }
}
