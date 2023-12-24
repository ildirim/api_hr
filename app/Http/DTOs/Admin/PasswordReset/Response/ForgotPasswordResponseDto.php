<?php

namespace App\Http\DTOs\Admin\PasswordReset\Response;

use Spatie\LaravelData\Data;

class ForgotPasswordResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $token,
    ) {
    }
}
