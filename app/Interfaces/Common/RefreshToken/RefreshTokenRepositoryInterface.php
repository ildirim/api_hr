<?php

namespace App\Interfaces\Common\RefreshToken;

use App\Models\RefreshToken;
use Illuminate\Database\Eloquent\Model;

interface RefreshTokenRepositoryInterface
{
    public function create(Model $tokenable, string $familyId, ?string $userAgent, ?string $ipAddress): RefreshToken;

    public function findByToken(string $token): ?RefreshToken;

    public function revokeToken(RefreshToken $token): bool;

    public function revokeTokenFamily(string $familyId): int;

    public function revokeAllUserTokens(Model $tokenable): int;

    public function deleteExpiredTokens(): int;
}
