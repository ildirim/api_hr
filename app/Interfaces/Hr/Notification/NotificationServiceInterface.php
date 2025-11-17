<?php

namespace App\Interfaces\Hr\Notification;

use Spatie\LaravelData\PaginatedDataCollection;

interface NotificationServiceInterface
{
    public function getNotifications(): ?PaginatedDataCollection;
}


