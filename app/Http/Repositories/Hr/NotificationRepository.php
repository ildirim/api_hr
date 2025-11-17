<?php

namespace App\Http\Repositories\Hr;

use App\Interfaces\Hr\Notification\NotificationRepositoryInterface;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function __construct(protected DatabaseNotification $notification)
    {
    }

    public function getNotificationsByAdminId(int $adminId): ?LengthAwarePaginator
    {
        return $this->notification
            ->where('notifiable_type', 'App\Models\Admin')
            ->where('notifiable_id', $adminId)
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}


