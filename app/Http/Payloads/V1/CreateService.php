<?php

declare(strict_types=1);

namespace App\Http\Payloads\V1;

final readonly class CreateService
{
    public function __construct(
        public string $name,
        public string $url,
        public string $user,
    ) {}

    /**
     * @return array {
     *     name: string,
     *     url: string,
     *     user_id: string,
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'user_id' => $this->user,
        ];
    }
}
