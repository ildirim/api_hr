<?php

namespace App\Providers;

use App\Http\Repositories\Admin\JobCategoryRepository;
use App\Http\Services\Admin\JobCategoryService;
use App\Interfaces\Admin\JobCategory\JobCategoryRepositoryInterface;
use App\Interfaces\Admin\JobCategory\JobCategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class JobCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JobCategoryServiceInterface::class, JobCategoryService::class);
        $this->app->bind(JobCategoryRepositoryInterface::class, JobCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
