<?php

namespace App\Providers;

use App\Http\Repositories\Admin\JobCategoryRepository;
use App\Http\Services\Admin\JobCategoryService;
use App\Interfaces\Admin\JobCategory\JobCategoryRepositoryInterface;
use App\Interfaces\Admin\JobCategory\JobCategoryServiceInterface;
use App\Http\Repositories\Hr\JobCategoryRepository as HrJobCategoryRepository;
use App\Http\Services\Hr\JobCategoryService as HrJobCategoryService;
use App\Interfaces\Hr\JobCategory\JobCategoryRepositoryInterface as HrJobCategoryRepositoryInterface;
use App\Interfaces\Hr\JobCategory\JobCategoryServiceInterface as HrJobCategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class JobCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // admin
        $this->app->bind(JobCategoryServiceInterface::class, JobCategoryService::class);
        $this->app->bind(JobCategoryRepositoryInterface::class, JobCategoryRepository::class);

        // hr
        // hr
        $this->app->bind(HrJobCategoryServiceInterface::class, HrJobCategoryService::class);
        $this->app->bind(HrJobCategoryRepositoryInterface::class, HrJobCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
