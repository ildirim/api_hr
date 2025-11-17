<?php

namespace App\Providers;

use App\Http\Repositories\Common\RefreshTokenRepository;
use App\Http\Services\Common\RefreshTokenService;
use App\Interfaces\Common\RefreshToken\RefreshTokenRepositoryInterface;
use App\Interfaces\Common\RefreshToken\RefreshTokenServiceInterface;
use Illuminate\Support\ServiceProvider;

class RefreshTokenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RefreshTokenServiceInterface::class, RefreshTokenService::class);
        $this->app->bind(RefreshTokenRepositoryInterface::class, RefreshTokenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}