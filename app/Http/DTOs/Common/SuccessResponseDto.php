<?php

namespace App\DTO\Common;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema(title: "Success response")]
class SuccessResponseDto extends Data
{
    public function __construct(
        #[OA\Property]
        public string $message,
        #[OA\Property]
        public string $status,
        #[OA\Property]
        public array|object|null $data = [],
    ) {}
}
