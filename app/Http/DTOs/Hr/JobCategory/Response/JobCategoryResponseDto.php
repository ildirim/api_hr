<?php

namespace App\Http\DTOs\Hr\JobCategory\Response;

use Spatie\LaravelData\Data;

class JobCategoryResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
