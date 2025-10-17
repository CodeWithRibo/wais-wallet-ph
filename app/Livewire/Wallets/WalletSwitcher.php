<?php

namespace App\Livewire\Wallets;

use Livewire\Component;

class WalletSwitcher extends Component
{
    public $wallet_option = 'all';
    public $remainingBalance = 0;

    public function mount(): void
    {
        $this->wallet_option == 'all' ? $this->remainingBalance = 20 : $this->remainingBalance = 0 ;
    }

    public function updatedWalletOption($value): void
    {
       switch ($value)
       {
           case 'all' :
               $this->remainingBalance = 20;
                break;
           case 'personal' :
               $this->remainingBalance = 300;
               break;
           case 'business' :
               $this->remainingBalance = 500;
               break;
           case 'shared' :
               $this->remainingBalance = 700;
               break;
       }
    }

    public function render()
    {
        return view('livewire.wallets.wallet-switcher');
    }
}

