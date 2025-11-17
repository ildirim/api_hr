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
}


