<?php

namespace App\Http\DTOs\Admin\EnumData\Request;

use App\Http\Requests\Admin\EnumDataRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EnumDataRequestDto extends Data
{
    public function __construct(
        public string $name,
        public string $target,
    ) {
    }

    public static function fromRequest(EnumDataRequest $request): static
    {
        return new self(
            $request->input('name'),
            $request->input('target'),
        );
    }
}
