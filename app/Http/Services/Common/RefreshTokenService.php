<?php

namespace App\Http\Services\Common;

use App\Exceptions\InvalidRefreshTokenException;
use App\Interfaces\Common\RefreshToken\RefreshTokenRepositoryInterface;
use App\Interfaces\Common\RefreshToken\RefreshTokenServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshTokenService implements RefreshTokenServiceInterface
{
    public function __construct(
        protected RefreshTokenRepositoryInterface $refreshTokenRepository
    ) {
    }

    public function createTokenPair(Model $user, array $jwtClaims = []): array
    {
        $familyId = hash('sha256', Str::random(64));

        // Create access token with claims
        $accessToken = JWTAuth::claims($jwtClaims)->fromUser($user);

        // Create refresh token
        $refreshToken = $this->refreshTokenRepository->create(
            $user,
            $familyId,
            request()->userAgent(),
            request()->ip()
        );

        return [
            'token' => $accessToken,
            'refresh_token' => $refreshToken->token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60, // seconds
        ];
    }

    public function refreshTokens(string $refreshToken): array
    {
        $token = $this->refreshTokenRepository->findByToken($refreshToken);

        if (!$token) {
            throw new InvalidRefreshTokenException(__('refresh_token_not_found'));
        }

        // Check if token is valid
        if ($token->isRevoked()) {
            // Token reuse detected - potential token theft
            // Revoke entire token family for security
            $this->refreshTokenRepository->revokeTokenFamily($token->family_id);
            throw new InvalidRefreshTokenException(__('refresh_token_revoked'));
        }

        if ($token->isExpired()) {
            throw new InvalidRefreshTokenException(__('refresh_token_expired'));
        }

        $user = $token->tokenable;

        if (!$user) {
            throw new InvalidRefreshTokenException(__('user_not_found'));
        }

        // Revoke current token (rotation)
        $this->refreshTokenRepository->revokeToken($token);

        // Create new token pair with same family ID
        $newRefreshToken = $this->refreshTokenRepository->create(
            $user,
            $token->family_id,
            request()->userAgent(),
            request()->ip()
        );

        // Generate new access token with user claims
        $jwtClaims = $this->getUserClaims($user);
        $accessToken = JWTAuth::claims($jwtClaims)->fromUser($user);

        return [
            'token' => $accessToken,
            'refresh_token' => $newRefreshToken->token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }

    public function revokeRefreshToken(string $refreshToken): bool
    {
        $token = $this->refreshTokenRepository->findByToken($refreshToken);

        if (!$token) {
            return false;
        }

        return $this->refreshTokenRepository->revokeToken($token);
    }

    public function revokeAllUserTokens(Model $user): int
    {
        return $this->refreshTokenRepository->revokeAllUserTokens($user);
    }

    public function cleanExpiredTokens(): int
    {
        return $this->refreshTokenRepository->deleteExpiredTokens();
    }

    protected function getUserClaims(Model $user): array
    {
        // Check if user has roles (for Admin model)
        if (method_exists($user, 'roles')) {
            $role = $user->roles->first();
            $permissions = $role?->permissions() ? $role->permissions()->pluck('name')->toArray() : [];

            return [
                'firstName' => $user->first_name ?? null,
                'lastName' => $user->last_name ?? null,
                'email' => $user->email ?? null,
                'phone' => $user->phone ?? null,
                'profileImage' => $user->profile_image ?? null,
                'status' => $user->status ?? null,
                'role' => $role?->name,
                'permissions' => $permissions,
            ];
        }

        return [];
    }
}
