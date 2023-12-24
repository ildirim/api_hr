<?php

namespace App\Http\DTOs\Admin\PasswordReset\Request;

use App\Http\Requests\Admin\ValidateTokenRequest;
use Spatie\LaravelData\Data;

class ValidateTokenRequestDto extends Data
{
    public function __construct(
        public string $token
    ) {
    }

    public static function fromRequest(ValidateTokenRequest $request): static
    {
        return new self(
            $request->input('token'),
        );
    }
}
