<?php

namespace App\Http\DTOs\Admin\Auth\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class ProfileResponseDto extends Data
{
    public function __construct(
        public int $sub,
        public string $firstName,
        public ?string $lastName,
        public ?string $email,
        public ?string $phone,
        public ?string $profileImage,
        public int $status,
        public ?string $role,
        public ?array $permissions,
    ) {
    }
}
