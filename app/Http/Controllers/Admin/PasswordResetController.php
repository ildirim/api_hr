<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\PasswordReset\Request\ForgotPasswordRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\PasswordResetRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateOtpCodeRequestDto;
use App\Http\DTOs\Admin\PasswordReset\Request\ValidateTokenRequestDto;
use App\Http\Requests\Admin\ConfirmPasswordRequest;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\PasswordResetRequest;
use App\Http\Requests\Admin\ValidateOtpCodeRequest;
use App\Http\Requests\Admin\ValidateTokenRequest;
use App\Interfaces\Admin\PasswordReset\PasswordResetServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PasswordResetController extends Controller
{
    public function __construct(protected PasswordResetServiceInterface $passwordResetService)
    {
    }

    public function validateToken(ValidateTokenRequest $request): JsonResponse
    {
        $dto = ValidateTokenRequestDto::fromRequest($request);
        $passwordReset = $this->passwordResetService->validateToken($dto);
        return $this->success(Response::HTTP_OK, $passwordReset);
    }

    public function validateOtpCode(ValidateOtpCodeRequest $request): JsonResponse
    {
        $dto = ValidateOtpCodeRequestDto::fromRequest($request);
        $passwordReset = $this->passwordResetService->validateOtpCode($dto);
        return $this->success(Response::HTTP_OK, $passwordReset);
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $passwordResetRequestDto = ForgotPasswordRequestDto::fromRequest($request);
        $passwordReset = $this->passwordResetService->forgotPassword($passwordResetRequestDto);
        return $this->success(Response::HTTP_CREATED, $passwordReset);
    }

    public function reset(PasswordResetRequest $request): JsonResponse
    {
        $passwordResetRequestDto = PasswordResetRequestDto::fromRequest($request);
        $passwordReset = $this->passwordResetService->reset($passwordResetRequestDto);
        return $this->success(Response::HTTP_OK, $passwordReset);
    }
}
