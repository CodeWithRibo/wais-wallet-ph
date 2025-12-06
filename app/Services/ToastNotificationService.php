<?php

namespace App\Services;

class ToastNotificationService
{
    public function __construct()
    {
    }

    public static function success($message): void
    {
         session()->flash('notify', [
            'content' => $message,
            'type' => 'success',
            'duration' => 3000
        ]);
    }

    public static function error($message): void
    {
        session()->flash('notify', [
            'content' => $message,
            'type' => 'error',
            'duration' => 3000
        ]);
    }

    public static function info($message): void
    {
        session()->flash('notify', [
            'content' => $message,
            'type' => 'info',
            'duration' => 3000
        ]);
    }
}
