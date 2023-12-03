<?php

namespace App\Providers;

use App\Http\Repositories\Hr\TemplateCategoryRepository;
use App\Http\Services\Hr\TemplateCategoryService;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class TemplateCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TemplateCategoryServiceInterface::class, TemplateCategoryService::class);
        $this->app->bind(TemplateCategoryRepositoryInterface::class, TemplateCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
