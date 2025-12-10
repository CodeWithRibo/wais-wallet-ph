<?php

namespace App\Livewire\Wallets;

use App\Models\Category;
use App\Models\Expense;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class WalletSwitcher extends Component
{
    public $totalSpent;
    public $totalBudget;
    public $remaining;
    public $budgetProgress;
    public $categoryBreakdown = [];

    public function calculateTotals($walletId = null)
    {

        $categories = Category::query()
            ->where('user_id', auth()->id())
            ->select('monthly_budget', 'category_name', 'id')->get();

        $expenses = Expense::query()
            ->where('user_id', auth()->id())
            ->when($walletId && $walletId !== 'all', fn($q) => $q->where('wallet_id', $walletId))
            ->get();

        $this->totalSpent = $expenses->sum('amount');
        $this->totalBudget = $categories->sum('monthly_budget');
        $this->remaining = $this->totalBudget - $this->totalSpent;
        $this->budgetProgress = ($this->totalSpent / $this->totalBudget) * 100;


            $this->categoryBreakdown = $categories->map(function ($category) use ($expenses) {
                $spent = $expenses->where('category_id', $category->id)->sum('amount');
                $percentage = $this->totalSpent > 0 ? round(($spent / $this->totalSpent) * 100, 2) : 0;

                return [
                    'category_name' => $category->category_name,
                    'spent' => $spent,
                    'percentage' => $percentage,
                ];
            })->filter(fn($item) => $item['spent'] > 0)->values()->toArray();

            if (empty($this->categoryBreakdown)) {
                $this->categoryBreakdown[] = [
                    'category_name' => 'No Data',
                    'spent' => 1,
                    'percentage' => 100,
                ];
            }

    }

    public function mount(): void
    {
        $this->calculateTotals('all');
        $this->dispatch('updateChart', categoryData: $this->categoryBreakdown);

    }

    public function updatedActiveWallet($value)
    {
        $this->calculateTotals($value);
        $this->dispatch('updateChart', categoryData: $this->categoryBreakdown);
    }

    public function render()
    {
        $totalSpent = $this->totalSpent;
        $totalBudget = $this->totalBudget;
        $remaining = $this->remaining;
        return view('livewire.wallets.wallet-switcher', compact(['totalSpent', 'totalBudget', 'remaining']));
    }
}

