<?php

namespace App\Providers;

use App\Http\Repositories\Admin\PackageRepository;
use App\Http\Services\Admin\PackageService;
use App\Interfaces\Admin\Package\PackageRepositoryInterface;
use App\Interfaces\Admin\Package\PackageServiceInterface;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PackageServiceInterface::class, PackageService::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
