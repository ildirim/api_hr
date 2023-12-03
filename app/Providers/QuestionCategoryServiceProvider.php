<?php

namespace App\Providers;

use App\Http\Repositories\Admin\QuestionCategoryRepository;
use App\Http\Services\Admin\QuestionCategoryService;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryRepositoryInterface;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class QuestionCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionCategoryServiceInterface::class, QuestionCategoryService::class);
        $this->app->bind(QuestionCategoryRepositoryInterface::class, QuestionCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
