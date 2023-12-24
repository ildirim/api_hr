<?php

namespace App\Http\DTOs\Admin\PasswordReset\Request;

use App\Http\Requests\Admin\PasswordResetRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PasswordResetRequestDto extends Data
{
    public function __construct(
        public string $password,
        public string $token,
        public string $completedAt,
    ) {
    }

    public static function fromRequest(PasswordResetRequest $request): static
    {
        return new self(
            bcrypt($request->input('password')),
            $request->input('token'),
            now()
        );
    }
}
