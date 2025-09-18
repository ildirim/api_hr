<?php

namespace App\Http\DTOs\Admin\Company\Request;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CompanyRequestDto extends Data
{
    #[Computed]
    public int $adminId;

    public function __construct(
        public string  $name,
        public string  $phone,
        public ?string $image,
        public ?string $address,
        public ?string $website,
        public ?string $about,
        public ?int    $status,
    )
    {
        $this->adminId = auth('admin')->id();
    }
}
