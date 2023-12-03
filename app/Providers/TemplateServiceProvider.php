<?php

namespace App\Providers;

use App\Http\Repositories\Admin\TemplateRepository;
use App\Http\Services\Admin\TemplateService;
use App\Interfaces\Admin\Template\TemplateRepositoryInterface;
use App\Interfaces\Admin\Template\TemplateServiceInterface;
use Illuminate\Support\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TemplateServiceInterface::class, TemplateService::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
