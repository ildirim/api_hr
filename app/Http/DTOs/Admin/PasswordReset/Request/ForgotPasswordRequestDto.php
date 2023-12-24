<?php

namespace App\Http\DTOs\Admin\PasswordReset\Request;

use App\Http\Enums\PasswordResetTypeEnum;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ForgotPasswordRequestDto extends Data
{
    public function __construct(
        public int $adminId,
        public ?string $phone,
        public ?string $email,
        public string $token,
        public bool $target,
        public string $otpCode,
        public string $expiredAt
    ) {
    }

    public static function fromRequest(ForgotPasswordRequest $request): static
    {
        return new self(
            $request->input('adminId'),
            $request->input('phone'),
            $request->input('email'),
            Str::random(64),
            !is_null($request->input('phone'))
                ? PasswordResetTypeEnum::PHONE->value
                : PasswordResetTypeEnum::EMAIL->value,
            mt_rand(1000000, 9999999),
            Carbon::now()->addMinutes(3)
        );
    }
}
