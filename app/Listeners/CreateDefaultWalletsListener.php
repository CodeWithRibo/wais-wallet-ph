<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateDefaultWalletsListener
{

    public function handle(Registered $event): void
    {
        $user = $event->user;

        $defaultWallets = [
            ['wallet_name' => 'Personal',
                'current_balance' => 1000,
                'wallet_type' => 'Personal'
            ],
            ['wallet_name' => 'Business',
                'current_balance' => 1000,
                'wallet_type' => 'Business'
            ],
            ['wallet_name' => 'Shared',
                'current_balance' => 1000,
                'wallet_type' => 'Shared'
            ],

        ];

        foreach ($defaultWallets as $wallet) {
            $user->wallet()->create($wallet);
        }
    }
}
