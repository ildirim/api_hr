<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Services\Admin\AuthService;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
        $this->middleware('auth:admin', ['except' => ['login','register']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');
//            $payload = [
//                'foo' => 'bar'
//            ];
//            $token = Auth::claims($payload)->attempt($credentials);;
            $token = Auth::attempt($credentials);;
            if (!$token) {
                return $this->error(Response::HTTP_FORBIDDEN, ['error' => 'Email və ya şifrə yanlışdır']);
            }

            $user = Auth::user();
            $user->token = $token;
            return $this->success(Response::HTTP_OK, $user);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => $e->getMessage()]);
        }
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
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
