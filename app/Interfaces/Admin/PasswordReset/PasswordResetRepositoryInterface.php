<?php

namespace App\Interfaces\Admin\PasswordReset;

use App\Http\DTOs\Admin\PasswordReset\Request\ForgotPasswordRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateTokenRequestDto;
use App\Models\AdminPasswordReset;

interface PasswordResetRepositoryInterface
{
    public function validateToken(ValidateTokenRequestDto $dto): AdminPasswordReset;

    public function forgotPassword(ForgotPasswordRequestDto $dto): AdminPasswordReset;
}
