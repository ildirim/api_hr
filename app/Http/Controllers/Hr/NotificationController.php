<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Interfaces\Hr\Notification\NotificationServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use BaseResponse;

    public function __construct(protected NotificationServiceInterface $notificationService)
    {
    }

    public function getNotifications(): JsonResponse
    {
        $notifications = $this->notificationService->getNotifications();
        return $this->success($notifications);
    }

    public function markAllAsRead(): JsonResponse
    {
        $count = $this->notificationService->markAllAsRead();
        return $this->success([
            'marked_as_read_count' => $count
        ], __('notifications_marked_as_read'));
    }

    public function markAsRead(string $id): JsonResponse
    {
        $this->notificationService->markAsRead($id);

        return $this->success(null, __('notification_marked_as_read'));
    }
}


