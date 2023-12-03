<?php

namespace App\Providers;

use App\Http\Repositories\Admin\EnumTypeRepository;
use App\Http\Services\Admin\EnumTypeService;
use App\Interfaces\Admin\EnumType\EnumTypeRepositoryInterface;
use App\Interfaces\Admin\EnumType\EnumTypeServiceInterface;
use Illuminate\Support\ServiceProvider;

class EnumTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EnumTypeServiceInterface::class, EnumTypeService::class);
        $this->app->bind(EnumTypeRepositoryInterface::class, EnumTypeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
