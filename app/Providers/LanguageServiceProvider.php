<?php

namespace App\Providers;

use App\Http\Repositories\Admin\LanguageRepository;
use App\Http\Services\Admin\LanguageService;
use App\Interfaces\Admin\Language\LanguageRepositoryInterface;
use App\Interfaces\Admin\Language\LanguageServiceInterface;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LanguageServiceInterface::class, LanguageService::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
