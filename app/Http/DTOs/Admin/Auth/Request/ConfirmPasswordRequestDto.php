<?php

namespace App\Http\DTOs\Admin\Auth\Request;

use App\Http\Enums\AdminStatusEnum;
use App\Http\Requests\Admin\ConfirmPasswordRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ConfirmPasswordRequestDto extends Data
{
    public function __construct(
        public string $password,
        public string $confirmPassword,
        public int $status,
    ) {
    }

    public static function fromRequest(ConfirmPasswordRequest $request): static
    {
        return new self(
            $request->input('password'),
            $request->input('confirmPassword'),
            AdminStatusEnum::ACTIVE->value
        );
    }
}
