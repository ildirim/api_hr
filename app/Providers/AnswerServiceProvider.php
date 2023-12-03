<?php

namespace App\Providers;

use App\Http\Repositories\Admin\AnswerRepository;
use App\Http\Services\Admin\AnswerService;
use App\Interfaces\Admin\Answer\AnswerRepositoryInterface;
use App\Interfaces\Admin\Answer\AnswerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AnswerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AnswerServiceInterface::class, AnswerService::class);
        $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
