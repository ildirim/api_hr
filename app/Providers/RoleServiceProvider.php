<?php

namespace App\Providers;

use App\Http\Repositories\Admin\RoleRepository;
use App\Http\Services\Admin\RoleService;
use App\Interfaces\Admin\Role\RoleRepositoryInterface;
use App\Interfaces\Admin\Role\RoleServiceInterface;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
