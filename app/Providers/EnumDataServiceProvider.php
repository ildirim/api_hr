<?php

namespace App\Providers;

use App\Http\Repositories\Admin\EnumDataRepository;
use App\Http\Services\Admin\EnumDataService;
use App\Interfaces\Admin\EnumData\EnumDataRepositoryInterface;
use App\Interfaces\Admin\EnumData\EnumDataServiceInterface;
use Illuminate\Support\ServiceProvider;

class EnumDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EnumDataServiceInterface::class, EnumDataService::class);
        $this->app->bind(EnumDataRepositoryInterface::class, EnumDataRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
