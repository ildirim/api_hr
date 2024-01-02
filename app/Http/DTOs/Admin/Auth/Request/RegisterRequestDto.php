<?php

namespace App\Http\DTOs\Admin\Auth\Request;

use App\Http\Enums\AdminStatusEnum;
use App\Http\Requests\Admin\RegisterRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RegisterRequestDto extends Data
{
    public function __construct(
        public int $roleId,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public int $status
    ) {
    }

    public static function fromRequest(RegisterRequest $request): static
    {
        return new self(
            $request->input('roleId'),
            $request->input('firstName'),
            $request->input('lastName'),
            $request->input('email'),
            $request->input('phone'),
            AdminStatusEnum::PENDING->value
        );
    }
}
