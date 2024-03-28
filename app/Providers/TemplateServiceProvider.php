<?php

namespace App\Providers;

use App\Http\Repositories\Admin\TemplateRepository;
use App\Http\Services\Admin\TemplateService;
use App\Interfaces\Admin\Template\TemplateRepositoryInterface;
use App\Interfaces\Admin\Template\TemplateServiceInterface;
use App\Http\Repositories\Hr\TemplateRepository as HrTemplateRepository;
use App\Http\Services\Hr\TemplateService as HrTemplateService;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface as HrTemplateRepositoryInterface;
use App\Interfaces\Hr\Template\TemplateServiceInterface as HrTemplateServiceInterface;
use Illuminate\Support\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // admin
        $this->app->bind(TemplateServiceInterface::class, TemplateService::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);

        // hr
        $this->app->bind(HrTemplateServiceInterface::class, HrTemplateService::class);
        $this->app->bind(HrTemplateRepositoryInterface::class, HrTemplateRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
