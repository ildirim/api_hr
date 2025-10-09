<?php

namespace App\Http\DTOs\Admin\PlanType\Request;

use App\Http\Requests\Admin\PlanTypeRequest;
use Spatie\LaravelData\Data;

class PlanTypeRequestDto extends Data
{
    public function __construct(
        public string $name,
    ) {
    }

    public static function fromRequest(PlanTypeRequest $request): static
    {
        return new self(
            $request->input('name'),
        );
    }
}


