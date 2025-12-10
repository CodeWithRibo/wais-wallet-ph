<?php

namespace App\Livewire\Admin;

use App\Models\Expense;
use App\Models\User;
use App\Models\Wallet;
use App\Services\UserAccountService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DashboardOverview extends Component
{
    public $totalExpense;
    public $totalExpensePercentage;
    public $activeUsers;
    public $totalUsers;
    public $average;

    public $expenseLabels = [];
    public $expenseData = [];

    public function mount()
    {
        $accountService = new UserAccountService();

        $this->totalExpenseWithPercentage();
        $this->getAllAndActiveUser($accountService);
        $this->avgMonthlyUserSpent();
        $this->loadExpenseData();
    }

    private function loadExpenseData()
    {
        $monthlyExpenses = Expense::select(
            DB::raw("TO_CHAR(created_at, 'YYYY-MM') as month"),
            DB::raw('SUM(amount) as total_amount')
        )->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy(DB::raw("TO_CHAR(created_at, 'YYYY-MM')"))
            ->orderBy('month', 'asc')
            ->get();

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            $found = $monthlyExpenses->firstWhere('month', $monthKey);

            $this->expenseLabels[] = $date->format('M Y');
            $this->expenseData[] = $found ? $found->total_amount : 0;
        }
    }

    private function avgMonthlyUserSpent()
    {
        $startDate = Carbon::now()->subDay(30);

        $totalSpending = Expense::where('created_at', '>=', $startDate)
            ->sum('amount');

        $spendPerUser = Expense::where('created_at', '>=', $startDate)
            ->distinct('user_id')
            ->count();

        if ($spendPerUser === 0)
            return 0.00;

        return $this->average = round(($totalSpending / $spendPerUser), 2) ?? 0;

    }

    public function getAllAndActiveUser(UserAccountService $accountService): void
    {
        $this->totalUsers = $accountService->getTotalUsers();
        $this->activeUsers = $accountService->getActiveUsers();
    }

    private function totalExpenseWithPercentage(): float
    {
        $yearExpense = Expense::whereYear('created_at', now()->year)->sum('amount');
        $this->totalExpense = Expense::sum('amount');

        if ($this->totalExpense == 0) {
            return 0.00;
        }
        return $this->totalExpensePercentage = round(($yearExpense / $this->totalExpense) * 100, 2);
    }

    #[Computed]
    public function totalBalance()
    {
        return Wallet::sum('current_balance');
    }

    #[Computed]
    public function topSpenders(): Collection
    {
        return Wallet::with('user')
            ->where('monthly_spent', '>=', '5000')
            ->limit(5)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.admin.dashboard-overview');
    }
}
