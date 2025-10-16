<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class WalletPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Wallet $wallet): bool
    {
    }

    public function create(User $user): Response
    {
        return $user->role === 'user'
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(User $user, Wallet $wallet): Response
    {
        return $user->id === $wallet->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function delete(User $user, Wallet $wallet): bool
    {
    }

    public function restore(User $user, Wallet $wallet): bool
    {
    }

    public function forceDelete(User $user, Wallet $wallet): bool
    {
    }
}
