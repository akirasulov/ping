<?php

namespace App\Jobs\Services;

use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteService implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Service $service,
    ) {}

    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn() => $this->service->delete(),
            attempts: 3,
        );
    }
}
