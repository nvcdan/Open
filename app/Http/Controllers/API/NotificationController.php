<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Notifications\DatabaseNotification as Notification;

class NotificationController extends Controller
{
    public function getNotifications(NotificationService $service, $id) {
        $notifications = User::findOrFail($id)->notifications()->orderBy('id', 'DESC')->limit(10)->get();
        $unread = count(User::findOrFail($id)->notifications()->where('read_at', null)->orderBy('id', 'DESC')->limit(10)->get());
        
        return response()->json([$service->notificationsAll($notifications), $unread]);
    }


    public function markNotificationRead($notifID) {
        Notification::findOrFail($notifID)->markAsRead();

        return response()->json('Notification marked as read.');
    }
}
