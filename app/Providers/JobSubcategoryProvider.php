<?php

namespace App\Providers;

use App\Http\Repositories\Admin\JobSubcategoryRepository;
use App\Http\Services\Admin\JobSubcategoryService;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryRepositoryInterface;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class JobSubcategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JobSubcategoryServiceInterface::class, JobSubcategoryService::class);
        $this->app->bind(JobSubcategoryRepositoryInterface::class, JobSubcategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
