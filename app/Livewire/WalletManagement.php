<?php

namespace App\Livewire;

use App\Models\Wallet;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class WalletManagement extends Component
{
    use WithPagination;

    public float $totalBalance;
    public float $availBal;
    public float $monthlySpent;
    public $user;

    public function wallet()
    {
        $this->user = auth()->user()->load('expense', 'wallet');
        $expense = $this->user->expense()->sum('amount') ?? 0;
        $currentBal = $this->user->wallet()->sum('current_balance') ?? 0;

        $available = $currentBal - $expense;

        $this->totalBalance = $currentBal;
        $this->monthlySpent = $expense;
        $this->availBal = $available;


    }

//    public function walletSummary()
//    {
//
//    }

    public function mount(): void
    {
        $this->wallet();
    }

    public function render(): View
    {
        $wallets = $this->user->wallet()
            ->select([
                'wallet_name',
                'current_balance',
                'monthly_spent',
                'transaction',
                'available_balance',
                'wallet_type'
            ])->get();

        return view('livewire.wallet-management', compact('wallets'));
    }
}
