<?php

namespace App\Providers;

use App\Http\Repositories\Admin\PasswordResetRepository;
use App\Http\Services\Admin\PasswordResetService;
use App\Interfaces\Admin\PasswordReset\PasswordResetRepositoryInterface;
use App\Interfaces\Admin\PasswordReset\PasswordResetServiceInterface;
use Illuminate\Support\ServiceProvider;

class PasswordResetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PasswordResetServiceInterface::class, PasswordResetService::class);
        $this->app->bind(PasswordResetRepositoryInterface::class, PasswordResetRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
