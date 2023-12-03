<?php

namespace App\Http\DTOs\Admin\EnumType\Request;

use App\Http\Requests\Admin\EnumTypeRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EnumTypeRequestDto extends Data
{
    public function __construct(
        public string $name,
        public string $target,
        public ?int $lastNumber,
    ) {
    }

    public static function fromRequest(EnumTypeRequest $request): static
    {
        return new self(
            $request->input('name'),
            $request->input('target'),
            $request->input('lastNumber'),
        );
    }
}
