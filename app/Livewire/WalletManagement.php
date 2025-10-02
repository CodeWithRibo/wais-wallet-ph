<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;

class WalletManagement extends Component
{
    public float $totalBalance;
    public float $availBal;
    public float $monthlySpent;

    public function mount(): void
    {
        $user = auth()->user()->load('expense', 'wallet');
        $expense = $user->expense->sum('amount') ?? 0 ;
        $currentBal = $user->wallet->sum('current_balance') ?? 0;

        $available = $currentBal - $expense;

        $this->totalBalance = $currentBal;
        $this->monthlySpent = $expense;
        $this->availBal = $available;
    }

    public function render()
    {
        return view('livewire.wallet-management');
    }
}
