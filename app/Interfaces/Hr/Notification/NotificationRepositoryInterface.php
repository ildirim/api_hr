<?php

namespace App\Interfaces\Hr\Notification;

use Illuminate\Pagination\LengthAwarePaginator;

interface NotificationRepositoryInterface
{
    public function getNotificationsByAdminId(int $adminId): ?LengthAwarePaginator;
}


