<?php

namespace App\Http\DTOs\Common;

use Spatie\LaravelData\Data;

class ErrorResponseDto extends Data
{
    public function __construct(
        public string $message,
        public string $status = 'error',
        /**
         * @OA\Property(
         *     oneOf={
         *         @OA\Schema(type="array", @OA\Items()),
         *         @OA\Schema(type="object"),
         *         @OA\Schema(type="null")
         *     },
         *     nullable=true
         * )
         */
    public array|object|null $errors = [],
    ) {}
}
