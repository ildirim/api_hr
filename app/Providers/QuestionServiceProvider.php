<?php

namespace App\Providers;

use App\Http\Repositories\Admin\QuestionRepository;
use App\Http\Services\Admin\QuestionService;
use App\Interfaces\Admin\Question\QuestionRepositoryInterface;
use App\Interfaces\Admin\Question\QuestionServiceInterface;
use App\Http\Repositories\Hr\QuestionRepository as HrQuestionRepository;
use App\Http\Services\Hr\QuestionService as HrQuestionService;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface as HrQuestionRepositoryInterface;
use App\Interfaces\Hr\Question\QuestionServiceInterface as HrQuestionServiceInterface;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // admin
        $this->app->bind(QuestionServiceInterface::class, QuestionService::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);

        // hr
        $this->app->bind(HrQuestionServiceInterface::class, HrQuestionService::class);
        $this->app->bind(HrQuestionRepositoryInterface::class, HrQuestionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
