<?php

namespace App\Services;

class ToastNotificationService
{
    public function __construct()
    {
    }

    public static function success($message): array
    {
        return [
            'type' => 'success',
            'content' => $message,
            'duration' => 4000,
        ];
    }

    public static function error($message): array
    {
        return [
            'type' => 'error',
            'content' => $message,
            'duration' => 4000,
        ];
    }

    public static function info($message): array
    {
        return [
            'type' => 'info',
            'content' => $message,
            'duration' => 4000,
        ];
    }
}
