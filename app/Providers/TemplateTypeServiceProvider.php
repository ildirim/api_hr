<?php

namespace App\Providers;

use App\Http\Repositories\Admin\TemplateTypeRepository;
use App\Http\Services\Admin\TemplateTypeService;
use App\Interfaces\Admin\TemplateType\TemplateTypeRepositoryInterface;
use App\Interfaces\Admin\TemplateType\TemplateTypeServiceInterface;
use Illuminate\Support\ServiceProvider;

class TemplateTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TemplateTypeServiceInterface::class, TemplateTypeService::class);
        $this->app->bind(TemplateTypeRepositoryInterface::class, TemplateTypeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}



