<?php

namespace App\DTO\Common;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema(title: "Error response")]
class ErrorResponseDto extends Data
{
    public function __construct(
        #[OA\Property]
        public string $message,
        #[OA\Property]
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
