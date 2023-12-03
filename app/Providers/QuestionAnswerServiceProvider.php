<?php

namespace App\Providers;

use App\Http\Services\Admin\QuestionAnswerService;
use App\Interfaces\Admin\QuestionAnswer\QuestionAnswerServiceInterface;
use Illuminate\Support\ServiceProvider;

class QuestionAnswerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionAnswerServiceInterface::class, QuestionAnswerService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
