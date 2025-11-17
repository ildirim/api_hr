<?php

namespace App\Interfaces\Common\RefreshToken;

use Illuminate\Database\Eloquent\Model;

interface RefreshTokenServiceInterface
{
    public function createTokenPair(Model $user, array $jwtClaims = []): array;

    public function refreshTokens(string $refreshToken): array;

    public function revokeRefreshToken(string $refreshToken): bool;

    public function revokeAllUserTokens(Model $user): int;

    public function cleanExpiredTokens(): int;
}