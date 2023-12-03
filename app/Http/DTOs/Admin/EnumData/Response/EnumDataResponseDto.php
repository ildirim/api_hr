<?php

namespace App\Http\DTOs\Admin\EnumData\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class EnumDataResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $enum_type_id,
        public string $name,
        public int $code,
    ) {
    }
}
