<?php

namespace App\Http\Repositories\Hr;

use App\Helpers\CommonHelper;
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
        $limit = CommonHelper::getLimit();
        return $this->notification
            ->where('notifiable_id', $adminId)
            ->where('notifiable_type', 'App\Models\Admin')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }
}
