<?php

namespace App\Http\DTOs\Admin\PasswordReset\Request;

use App\Http\Requests\Admin\ValidateOtpCodeRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ValidateOtpCodeRequestDto extends Data
{
    public function __construct(
        public string $otpCode,
        public string $token
    ) {
    }

    public static function fromRequest(ValidateOtpCodeRequest $request): static
    {
        return new self(
            $request->input('otpCode'),
            $request->input('token'),
        );
    }
}
