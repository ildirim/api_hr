<?php

namespace App\Providers;

use App\Http\Repositories\Admin\JobSubcategoryRepository as AdminJobSubcategoryRepository;
use App\Http\Services\Admin\JobSubcategoryService as AdminJobSubcategoryService;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryRepositoryInterface as AdminJobSubcategoryRepositoryInterface;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryServiceInterface as AdminJobSubcategoryServiceInterface;
use App\Http\Repositories\Hr\JobSubcategoryRepository as HrJobSubcategoryRepository;
use App\Http\Services\Hr\JobSubcategoryService as HrJobSubcategoryService;
use App\Interfaces\Hr\JobSubcategory\JobSubcategoryRepositoryInterface as HrJobSubcategoryRepositoryInterface;
use App\Interfaces\Hr\JobSubcategory\JobSubcategoryServiceInterface as HrJobSubcategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class JobSubcategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AdminJobSubcategoryServiceInterface::class, AdminJobSubcategoryService::class);
        $this->app->bind(AdminJobSubcategoryRepositoryInterface::class, AdminJobSubcategoryRepository::class);

        // hr
        $this->app->bind(HrJobSubcategoryServiceInterface::class, HrJobSubcategoryService::class);
        $this->app->bind(HrJobSubcategoryRepositoryInterface::class, HrJobSubcategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
