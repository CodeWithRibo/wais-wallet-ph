<?php

namespace App\Livewire\Wallets;

use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class WalletManagement extends Component
{
    use WithPagination;

    public float $totalBalance;
    public float $availBal;
    public float $monthlySpent;
    public $user;
    public $cycleStart;
    public $cycleEnd;
    public $firstExpenseDate;


    public function sumWallet(): void
    {
        $this->user = auth()->user()->load('expense', 'wallet');

        $this->firstExpenseDate = $this->user->expense()
            ->orderBy('created_at')
            ->value('created_at');

        if ($this->firstExpenseDate) {

            $start = Carbon::parse($this->firstExpenseDate)->startOfDay();
            $today = Carbon::now();

            while ($today->gte($start->copy()->addMonth())) {
                $start->addMonth();
            }

            $cycleStart = $start->copy();
            $cycleEnd = $start->copy()->addMonth();

            $this->monthlySpent = $this->user->expense()
                ->whereBetween('created_at', [$cycleStart,  $cycleEnd])
                ->sum('amount');

            $this->cycleStart = $cycleStart;
            $this->cycleEnd = $cycleEnd;

        } else {
            $this->monthlySpent = 0;
        }

        $currentBal = $this->user->wallet()->sum('current_balance') ?? 0;

        $this->totalBalance = $currentBal;
        $this->availBal = $currentBal - $this->monthlySpent;

    }

    public function edit($id): void
    {
        $this->dispatch('edit-wallet', id: $id);
    }

    #[On(['createWallet', 'refreshEditWallet'])]
    public function refreshWallet(): void
    {

    }

    public function render(): View
    {
        $this->sumWallet();
        $wallets = $this->user->wallet()
            ->select([
                'id',
                'wallet_name',
                'current_balance',
                'monthly_spent',
                'transaction',
                'available_balance',
                'wallet_type'
            ])->get();

        return view('livewire.wallets.wallet-management', compact('wallets'));
    }
}
