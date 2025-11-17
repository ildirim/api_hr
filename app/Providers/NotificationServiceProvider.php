<?php

namespace App\Providers;

use App\Http\Repositories\Hr\NotificationRepository;
use App\Http\Services\Hr\NotificationService;
use App\Interfaces\Hr\Notification\NotificationRepositoryInterface;
use App\Interfaces\Hr\Notification\NotificationServiceInterface;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}


