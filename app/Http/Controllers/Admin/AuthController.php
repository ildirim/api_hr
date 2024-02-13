<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Auth\Request\ConfirmPasswordRequestDto;
use App\Http\DTOs\Admin\Auth\Request\PasswordRequestDto;
use App\Http\DTOs\Admin\Auth\Request\RegisterRequestDto;
use App\Http\Enums\ActivationStatusEnum;
use App\Http\Enums\AdminStatusEnum;
use App\Http\Requests\Admin\ConfirmPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\PasswordRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Services\Admin\AuthService;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
        $this->middleware('auth:admin', ['except' => ['login', 'loginWithGoogle', 'redirectToGoogle', 'register', 'confirmPassword']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            $token = auth('admin')->attempt($credentials);
            if (!$token) {
                return $this->error(Response::HTTP_FORBIDDEN, ['error' => __('email_and_password_are_wrong')]);
            }
            $admin = Admin::find(auth('admin')->user()->id);
            if ($admin->status == AdminStatusEnum::DEACTIVE->value) {
                return $this->error(Response::HTTP_FORBIDDEN, ['error' => __('account_is_not_active')]);
            }
            $token = $this->payloadToToken($admin, $credentials);
            $response = [
                'token' => $token
            ];
            return $this->success(Response::HTTP_OK, $response);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => $e->getMessage()]);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function loginWithGoogle()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $admin = Admin::whereEmail($googleUser->email)->first();
        if (!$admin) {
            $request = [
                'first_name' => $googleUser->user['given_name'],
                'last_name' => $googleUser->user['family_name'],
                'email' => $googleUser->email,
                'profile_image' => $googleUser->user['picture'],
                'password' => bcrypt(Str::random(12)),
                'status' => AdminStatusEnum::ACTIVE->value
            ];
            $admin = Admin::create($request);
        }
        return $admin;
    }

    public function payloadToToken(
        Admin $admin,
        array $credentials,
    ): string
    {
        $permissionNames = [];
        $roleNames = [];
        foreach ($admin->roles as $role)  {
            $roleNames[] = $role->name;
            $permissionNames = array_merge($permissionNames, $role->permissions->pluck('name')->toArray());
        }
        $payload = [
            'firstName' => $admin->first_name,
            'last_name' => $admin->lastName,
            'email' => $admin->email,
            'phone' => $admin->phone,
            'profileImage' => $admin->profile_image,
            'status' => $admin->status,
            'role' => $roleNames,
            'permissions' => $permissionNames
        ];

        return JWTAuth::claims($payload)->attempt($credentials);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $requestDto = RegisterRequestDto::fromRequest($request);
        $admin = Admin::create($requestDto->toArray());

        return $this->success(Response::HTTP_OK, ['admin' => $admin]);
    }

    public function confirmPassword(int $id, ConfirmPasswordRequest $request): JsonResponse
    {
        $requestDto = ConfirmPasswordRequestDto::fromRequest($request);
        $admin = Admin::find($id);
        if (!$admin) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => __('user_not_found')]);
        }
        if ($admin->status != AdminStatusEnum::PENDING->value) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => __('user_already_exist')]);
        }
        $admin->update($requestDto->toArray());

        $token = auth('admin')->login($admin);
        return $this->success(Response::HTTP_OK, ['token' => $token]);
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

    public function profile()
    {
        try {
            $profile = $this->authService->profile();
            return $this->success(Response::HTTP_OK, $profile);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
    }
}
