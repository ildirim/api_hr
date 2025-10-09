<?php

namespace App\Providers;

use App\Http\Repositories\Admin\PlanTypeRepository;
use App\Http\Services\Admin\PlanTypeService;
use App\Interfaces\Admin\PlanType\PlanTypeRepositoryInterface;
use App\Interfaces\Admin\PlanType\PlanTypeServiceInterface;
use Illuminate\Support\ServiceProvider;

class PlanTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PlanTypeServiceInterface::class, PlanTypeService::class);
        $this->app->bind(PlanTypeRepositoryInterface::class, PlanTypeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}


