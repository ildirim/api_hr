<?php

namespace App\Interfaces\Admin\PasswordReset;

use App\Http\DTOs\Admin\PasswordReset\Request\ForgotPasswordRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateTokenRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Response\ForgotPasswordResponseDto;

interface PasswordResetServiceInterface
{
    public function validateToken(ValidateTokenRequestDto $dto): ForgotPasswordResponseDto;

    public function forgotPassword(ForgotPasswordRequestDto $dto): ForgotPasswordResponseDto;
}
