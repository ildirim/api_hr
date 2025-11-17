<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Enums\AdminStatusEnum;
use App\Http\Requests\Admin\ConfirmPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\PasswordRequest;
use App\Http\Requests\Admin\RefreshTokenRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Services\Admin\AuthService;
use App\Interfaces\Common\RefreshToken\RefreshTokenServiceInterface;
use App\Models\Admin;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    use BaseResponse;

    public function __construct(
        private readonly AuthService $authService,
        private readonly RefreshTokenServiceInterface $refreshTokenService
    ) {
        $this->middleware('auth:admin', ['except' => ['login', 'loginWithGoogle', 'redirectToGoogle', 'register', 'confirmPassword', 'refreshToken']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = isset($request->email)
            ? $request->only('email', 'password')
            : $request->only('phone', 'password');

        $token = auth('admin')->attempt($credentials);
        if (!$token) {
            return $this->error(null, __('email_and_password_are_wrong'));
        }
        $admin = Admin::find(auth('admin')->user()->id);
        if ($admin->status == AdminStatusEnum::INACTIVE->value) {
            return $this->error(null, __('account_is_not_active'));
        }

        // Generate token pair with refresh token
        $jwtClaims = $this->getAdminClaims($admin);
        $tokenPair = $this->refreshTokenService->createTokenPair($admin, $jwtClaims);

        return $this->success($tokenPair);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function payloadToToken(
        Admin $admin,
        array $credentials,
    ): string
    {
        /** @var $user Admin */
        $role = $admin->roles->first();
        $permissions = $role?->permissions() ? $role->permissions()->pluck('name')->toArray() : [];
        $payload = [
            'firstName' => $admin->first_name,
            'lastName' => $admin->last_name,
            'email' => $admin->email,
            'phone' => $admin->phone,
            'profileImage' => $admin->profile_image,
            'status' => $admin->status,
            'role' => $role?->name,
            'permissions' => $permissions
        ];
        return JWTAuth::claims($payload)->attempt($credentials);
    }

    protected function getAdminClaims(Admin $admin): array
    {
        $role = $admin->roles->first();
        $permissions = $role?->permissions() ? $role->permissions()->pluck('name')->toArray() : [];

        return [
            'firstName' => $admin->first_name,
            'lastName' => $admin->last_name,
            'email' => $admin->email,
            'phone' => $admin->phone,
            'profileImage' => $admin->profile_image,
            'status' => $admin->status,
            'role' => $role?->name,
            'permissions' => $permissions,
        ];
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $this->authService->register($request);
        return $this->success(null, __('account_created'), 'success', Response::HTTP_CREATED);
    }

    public function confirmPassword(ConfirmPasswordRequest $request): JsonResponse
    {
        $token = $this->authService->confirmPassword($request);
        return $this->success(['token' => $token]);
    }

    public function updatePassword(int $id, PasswordRequest $request)
    {
        $passwordRequestDto = PasswordRequestDto::fromRequest($request);
        $password = $this->authService->update($id, $passwordRequestDto);
    }

    public function logout(): JsonResponse
    {
        auth('admin')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function logoutWithRefreshToken(RefreshTokenRequest $request): JsonResponse
    {
        $this->refreshTokenService->revokeRefreshToken($request->refresh_token);
        auth('admin')->logout();

        return $this->success(null, __('successfully_logged_out'));
    }

    public function logoutAllDevices(): JsonResponse
    {
        $user = auth('admin')->user();
        $this->refreshTokenService->revokeAllUserTokens($user);
        auth('admin')->logout();

        return $this->success(null, __('logged_out_from_all_devices'));
    }

    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        $tokenPair = $this->refreshTokenService->refreshTokens($request->refresh_token);

        return $this->success($tokenPair);
    }

    public function refresh(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => auth('admin')->user(),
            'authorization' => [
                'token' => auth('admin')->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function profile(): JsonResponse
    {
        try {
            $profile = $this->authService->profile();
            return $this->success($profile);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 400);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 400);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 400);
        }
    }
}
