<?php

namespace App\Http\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Auth\Request\RegisterRequestDto;
use App\Http\DTOs\Admin\Auth\Response\ProfileResponseDto;
use App\Http\Requests\Admin\ConfirmPasswordRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Interfaces\Admin\Admin\AdminRepositoryInterface;
use App\Interfaces\Admin\Auth\AuthServiceInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Cache;

readonly class AuthService implements AuthServiceInterface
{
    public function __construct(private AdminRepositoryInterface $adminRepository)
    {
    }

    public function profile(): ProfileResponseDto
    {
        $admin = Admin::me();
        return ProfileResponseDto::from($admin);
    }

    public function register(RegisterRequest $request): void
    {
        $requestDto = RegisterRequestDto::from($request->toArray());
        $cacheKey = "admin:{$requestDto->email}:{$requestDto->phone}";
        $existsAdminCache = Cache::has($cacheKey);
        if (!$existsAdminCache) {
            Cache::put($cacheKey, $requestDto, 180);
        }
    }

    public function confirmPassword(ConfirmPasswordRequest $request): string
    {
        $cacheKey = "admin:{$request->email}:{$request->phone}";
        $existsAdminCache = Cache::has($cacheKey);
        if (!$existsAdminCache) {
            throw new NotFoundException('User not found');
        }
        $registerDto = Cache::get($cacheKey);
        $registerDto->password = bcrypt($request->get('password'));;
        $admin = $this->adminRepository->register($registerDto);
        $admin->assignRole('admin');

        return auth('admin')->login($admin);
    }
}
