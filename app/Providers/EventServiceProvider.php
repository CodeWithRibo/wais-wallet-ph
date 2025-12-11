<?php

namespace App\Providers;

use App\Listeners\CreateDefaultCategoriesListener;
use App\Listeners\CreateDefaultWalletsListener;
use App\Listeners\UserLoginAtListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            CreateDefaultWalletsListener::class,
            CreateDefaultCategoriesListener::class,
            UserLoginAtListener::class,
        ]
    ];

    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}
