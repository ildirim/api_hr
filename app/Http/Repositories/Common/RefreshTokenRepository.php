<?php

namespace App\Http\Repositories\Common;

use App\Interfaces\Common\RefreshToken\RefreshTokenRepositoryInterface;
use App\Models\RefreshToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    public function __construct(protected RefreshToken $refreshToken)
    {
    }

    public function create(Model $tokenable, string $familyId, ?string $userAgent, ?string $ipAddress): RefreshToken
    {
        $expiresAt = now()->addDays(config('jwt.refresh_ttl', 20160) / 1440); // Convert minutes to days

        return $this->refreshToken->create([
            'token' => hash('sha256', Str::random(64)),
            'tokenable_type' => get_class($tokenable),
            'tokenable_id' => $tokenable->getKey(),
            'family_id' => $familyId,
            'user_agent' => $userAgent ? Str::limit($userAgent, 255) : null,
            'ip_address' => $ipAddress,
            'revoked' => false,
            'expires_at' => $expiresAt,
        ]);
    }

    public function findByToken(string $token): ?RefreshToken
    {
        return $this->refreshToken
            ->where('token', $token)
            ->with('tokenable')
            ->first();
    }

    public function revokeToken(RefreshToken $token): bool
    {
        return $token->update(['revoked' => true]);
    }

    public function revokeTokenFamily(string $familyId): int
    {
        return $this->refreshToken
            ->where('family_id', $familyId)
            ->update(['revoked' => true]);
    }

    public function revokeAllUserTokens(Model $tokenable): int
    {
        return $this->refreshToken
            ->where('tokenable_type', get_class($tokenable))
            ->where('tokenable_id', $tokenable->getKey())
            ->update(['revoked' => true]);
    }

    public function deleteExpiredTokens(): int
    {
        return $this->refreshToken
            ->where('expires_at', '<', now())
            ->orWhere('revoked', true)
            ->delete();
    }
}
