<?php

namespace App\Http\DTOs\Admin\EnumType\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class EnumTypeResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $target,
        public ?int $last_number,
    ) {
    }
}
