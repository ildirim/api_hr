<?php

namespace App\Http\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\PasswordReset\Request\ForgotPasswordRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\PasswordResetRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateOtpCodeRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateTokenRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Response\ForgotPasswordResponseDto;
use App\Interfaces\Admin\PasswordReset\PasswordResetServiceInterface;
use App\Interfaces\Admin\PasswordReset\PasswordResetRepositoryInterface;
use App\Models\Admin;

class PasswordResetService implements PasswordResetServiceInterface
{
    public function __construct(protected PasswordResetRepositoryInterface $passwordResetRepository)
    {
    }

    public function validateToken(ValidateTokenRequestDto $dto): ForgotPasswordResponseDto
    {
        $token = $this->passwordResetRepository->validateToken($dto);
        return ForgotPasswordResponseDto::from($token);
    }

    public function validateOtpCode(ValidateOtpCodeRequestDto $dto): ForgotPasswordResponseDto
    {
        $passwordReset = $this->passwordResetRepository->validateOtpCode($dto);
        $this->passwordResetRepository->updateConfirmedAt($passwordReset);
        return ForgotPasswordResponseDto::from($passwordReset);
    }

    public function forgotPassword(ForgotPasswordRequestDto $dto): ForgotPasswordResponseDto
    {
        if ($dto->email) {
            $admin = Admin::where('email', $dto->email)->first();
        } else {
            $admin = Admin::where('phone', $dto->phone)->first();
        }
        if (!$admin) {
            throw new NotFoundException('Admin not found');
        }
        $dto->additional(['admin_id' => $admin->id]);
        return ForgotPasswordResponseDto::from($this->passwordResetRepository->forgotPassword($dto));
    }

    public function reset(PasswordResetRequestDto $dto): bool
    {
        $request = $dto->toArray();
        $passwordReset = $this->passwordResetRepository->notConfirmedPasswordResetByToken($request['token']);
        if (!$passwordReset) {
            throw new NotFoundException('Token tapılmadı');
        }
        $admin = Admin::find($passwordReset->admin_id);
        $result = $this->passwordResetRepository->updateCompletedAt($passwordReset, $request['completed_at']);
        $admin->update(['password' => $request['password']]);
        return $result;
    }
}
