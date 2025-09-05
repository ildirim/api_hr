<?php

namespace App\Http\DTOs\Common;

use Spatie\LaravelData\Data;

class SuccessResponseDto extends Data
{
    public function __construct(
        public string $message,
        public string $status,
        public array|object|null $data = [],
    ) {}
}
