<?php

namespace App\Providers;

use App\Http\Repositories\Admin\CompanyRepository;
use App\Http\Services\Admin\CompanyService;
use App\Interfaces\Admin\Company\CompanyRepositoryInterface;
use App\Interfaces\Admin\Company\CompanyServiceInterface;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
