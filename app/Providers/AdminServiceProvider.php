<?php

namespace App\Providers;

use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Services\Admin\AdminService;
use App\Interfaces\Admin\Admin\AdminRepositoryInterface;
use App\Interfaces\Admin\Admin\AdminServiceInterface;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
