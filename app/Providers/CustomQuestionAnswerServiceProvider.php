<?php

namespace App\Providers;

use App\Http\Services\Hr\CustomQuestionAnswerService;
use App\Interfaces\Hr\CustomQuestionAnswer\CustomQuestionAnswerServiceInterface;
use Illuminate\Support\ServiceProvider;

class CustomQuestionAnswerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomQuestionAnswerServiceInterface::class, CustomQuestionAnswerService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
