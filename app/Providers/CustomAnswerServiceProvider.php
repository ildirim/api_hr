<?php

namespace App\Providers;

use App\Http\Repositories\Hr\CustomAnswerRepository;
use App\Http\Services\Hr\CustomAnswerService;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerRepositoryInterface;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerServiceInterface;
use Illuminate\Support\ServiceProvider;

class CustomAnswerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomAnswerServiceInterface::class, CustomAnswerService::class);
        $this->app->bind(CustomAnswerRepositoryInterface::class, CustomAnswerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
