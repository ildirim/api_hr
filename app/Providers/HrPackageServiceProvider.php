<?php

namespace App\Providers;

use App\Http\Repositories\Hr\AdminBalanceRepository;
use App\Http\Repositories\Hr\PackageRepository;
use App\Http\Repositories\Hr\TransactionRepository;
use App\Http\Services\Hr\PackageService;
use App\Interfaces\Hr\AdminBalance\AdminBalanceRepositoryInterface;
use App\Interfaces\Hr\Package\PackageRepositoryInterface;
use App\Interfaces\Hr\Package\PackageServiceInterface;
use App\Interfaces\Hr\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class HrPackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PackageServiceInterface::class, PackageService::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(AdminBalanceRepositoryInterface::class, AdminBalanceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

