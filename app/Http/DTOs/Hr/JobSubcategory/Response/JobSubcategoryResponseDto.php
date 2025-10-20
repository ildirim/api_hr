<?php

namespace App\Http\DTOs\Hr\JobSubcategory\Response;

use Spatie\LaravelData\Data;

class JobSubcategoryResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
