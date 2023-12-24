<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\PasswordReset\Request\ForgotPasswordRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateOtpCodeRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateTokenRequestDto;
use App\Interfaces\Admin\PasswordReset\PasswordResetRepositoryInterface;
use App\Models\AdminPasswordReset;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    public function __construct(protected AdminPasswordReset $passwordReset)
    {
    }

    public function notConfirmedPasswordResetByToken(string $token): ?AdminPasswordReset
    {
        return $this->passwordReset->select('id', 'admin_id', 'token')
            ->where('token', $token)
            ->where('expired_at', '>=', date('Y-m-d H:i:s'))
            ->whereNull('completed_at')
            ->first();
    }

    public function validateToken(ValidateTokenRequestDto $dto): AdminPasswordReset
    {
        $request = $dto->toArray();
        $passwordReset = $this->passwordReset->select('id', 'token')
            ->where('token', $request['token'])
            ->where('expired_at', '>=', date('Y-m-d H:i:s'))
            ->whereNull('confirmed_at')
            ->first();
        if (!$passwordReset) {
            throw new NotFoundException('Token üzrə məlumat tapılmadı');
        }
        return $passwordReset;
    }

    public function validateOtpCode(ValidateOtpCodeRequestDto $dto): AdminPasswordReset
    {
        $request = $dto->toArray();
        $passwordReset = $this->passwordReset->select('id', 'token')
            ->where('token', $request['token'])
            ->where('otp_code', $request['otp_code'])
            ->where('expired_at', '>=', date('Y-m-d H:i:s'))
            ->whereNull('confirmed_at')
            ->first();
        if (!$passwordReset) {
            throw new NotFoundException('Token üzrə məlumat tapılmadı');
        }
        return $passwordReset;
    }

    public function forgotPassword(ForgotPasswordRequestDto $dto): AdminPasswordReset
    {
        return $this->passwordReset->create($dto->toArray());
    }

    public function reset(int $id, PasswordResetRequestDto $dto): AdminPasswordReset
    {
        $passwordReset = $this->passwordReset->find($id);
        if (!$passwordReset) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }

        return $passwordReset->update($dto->toArray());
    }

    public function updateConfirmedAt(AdminPasswordReset $passwordReset): bool
    {
        return $passwordReset->update(['confirmed_at' => now()]);
    }

    public function updateCompletedAt(AdminPasswordReset $passwordReset, string $completedAt): bool
    {
        return $passwordReset->update(['completed_at' => $completedAt]);
    }
}
