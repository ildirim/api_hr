<?php

namespace App\Providers;

use App\Http\Repositories\Admin\PermissionRepository;
use App\Http\Services\Admin\PermissionService;
use App\Interfaces\Admin\Permission\PermissionRepositoryInterface;
use App\Interfaces\Admin\Permission\PermissionServiceInterface;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
