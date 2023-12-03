<?php

namespace App\Http\DTOs\Admin\Company\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class CompanyResponseDto extends Data
{
    public function __construct(
        public ?int    $id,
        public int     $admin_id,
        public string  $name,
        public string  $phone,
        public ?string $image,
        public ?string $address,
        public ?string $website,
        public ?string $about,
        public ?int    $status,
    )
    {
    }
}
