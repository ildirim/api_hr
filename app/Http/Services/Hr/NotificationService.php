<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\Notification\Response\NotificationResponseDto;
use App\Interfaces\Hr\Notification\NotificationRepositoryInterface;
use App\Interfaces\Hr\Notification\NotificationServiceInterface;
use Spatie\LaravelData\PaginatedDataCollection;

class NotificationService implements NotificationServiceInterface
{
    public function __construct(
        protected NotificationRepositoryInterface $notificationRepository,
    )
    {
    }

    public function getNotifications(): ?PaginatedDataCollection
    {
        $adminId = auth('admin')->user()->id;
        $notifications = $this->notificationRepository->getNotificationsByAdminId($adminId);

        return NotificationResponseDto::collection($notifications);
    }

    public function markAsRead(string $notificationId): void
    {
        $user = auth('admin')->user();
        $user->unreadNotifications->where('id', $notificationId)->markAsRead();
    }

    public function markAllAsRead()
    {
        $user = auth('admin')->user();
        return $user->unreadNotifications->markAsRead();
    }
}


