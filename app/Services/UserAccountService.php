<?php

namespace App\Services;

use App\Livewire\Concerns\HasToast;
use App\Models\User;

class UserAccountService
{
    use HasToast;

    public function __construct()
    {
    }

    public static function getAllUsersWithWallet()
    {
        return User::with('wallet')
            ->withCount('wallet')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function getTotalUsers(): int
    {
        return User::count('email');
    }

    public function getActiveUsers(): int
    {
        return User::where('is_active', true)->count();
    }

    public function getInactiveUsers(): int
    {
        return User::where('is_active', false)->count();
    }

    public function createAccount(array $user)
    {
        $success = User::query()->create([
            'is_active' => true,
            ... $user
        ]);

        if ($success) {
            $this->success('Account successfully created');
            return redirect()->route('admin.dashboard');
        }
        return $success;
    }
}
