<?php

namespace App\Providers;

use App\Http\Services\Admin\AuthService;
use App\Interfaces\Admin\Auth\AuthServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
