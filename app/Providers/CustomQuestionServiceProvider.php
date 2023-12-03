<?php

namespace App\Providers;

use App\Http\Repositories\Hr\CustomQuestionRepository;
use App\Http\Services\Hr\CustomQuestionService;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionRepositoryInterface;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use Illuminate\Support\ServiceProvider;

class CustomQuestionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomQuestionServiceInterface::class, CustomQuestionService::class);
        $this->app->bind(CustomQuestionRepositoryInterface::class, CustomQuestionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
