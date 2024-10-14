<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctun', 'throttle:api'])->group(function (): void {
    Route::get('/user', static fn(Request $request) => $request->user())
        ->name('user');

    Route::prefix('services')->as('services:')
        ->group(base_path('routes/api/services.php'))
        ->middleware(['throttle:100,1']);

    Route::prefix('credentials')->as('credentials:')
        ->group(base_path('routes/api/credentials.php'));

    Route::prefix('checks')->as('checks:')
        ->group(base_path('routes/api/checks.php'));
});
