<?php

namespace App\Http\DTOs\Admin\Auth\Request;

use App\Http\Enums\AdminStatusEnum;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RegisterRequestDto extends Data
{

    #[Computed]
    public int $status;

    public function __construct(
        public string $firstName,
        public string $lastName,
        public ?string $email,
        public ?string $phone,
        public null|string $password = null,
        public int $roleId = 1,
    ) {
        $this->status = AdminStatusEnum::PENDING->value;
    }
}
