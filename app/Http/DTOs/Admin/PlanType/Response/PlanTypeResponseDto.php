<?php

namespace App\Http\DTOs\Admin\PlanType\Response;

use Spatie\LaravelData\Data;

class PlanTypeResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}


