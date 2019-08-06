<?php

namespace App\Services;

class NotificationService 
{
    public function notificationsAll($notifications) {
        $notificationCorrect = [];
        $notificationString = '';

        foreach($notifications as $notification) {
            switch($notification->type) {
                case 'App\Notifications\ProjectUpdated': {
                    $notificationString = "A project was updated: ";
                    break;
                };
                case 'App\Notifications\TaskCreated': {
                    $notificationString = "A new task was created for project: ";
                }
            }
            $notificationString = $notificationString . $notification->data['project_name'];
            array_push($notificationCorrect, ['id' => $notification->id, 'string' => $notificationString, 'read_at'=> $notification->read_at, 'created_at' => $notification->created_at->diffForHumans()]);
        }


        return $notificationCorrect;
    }
}