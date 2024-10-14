<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('checks', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('path');
            $table->string('method')->default('GET');

            $table->text('body')->nullable();
            $table->text('headers')->nullable();
            $table->text('parameters')->nullable();

            $table
                ->foreignUlid('credential_id')
                ->index()
                ->constrained('credentials')
                ->cascadeOnDelete();

            $table
                ->foreignUlid('services_id')
                ->index()
                ->constrained('services')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checks');
    }
};
