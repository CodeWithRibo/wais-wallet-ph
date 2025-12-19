<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Wallet;
use App\Services\UserAccountService;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $totalUsers;
    public $activeUsers;
    public $inactiveUsers;
    public $totalWallets;

    public function mount(): void
    {
        $accountService = new UserAccountService();
        $this->getAllAndActiveUser($accountService);
        $this->getTotalWallets();
    }

    private function getTotalWallets(): void
    {
        $this->totalWallets = Wallet::pluck('wallet_name')->count();
    }

    private function getAllAndActiveUser(UserAccountService $accountService): void
    {
        $this->totalUsers = $accountService->getTotalUsers();
        $this->activeUsers = $accountService->getActiveUsers();
        $this->inactiveUsers = $accountService->getInactiveUsers();
    }

    #[Computed]
    public function users()
    {
        return UserAccountService::getAllUsersWithWallet();
    }

    public function render(): View
    {
        return view('livewire.admin.users.user-management');
    }
}
