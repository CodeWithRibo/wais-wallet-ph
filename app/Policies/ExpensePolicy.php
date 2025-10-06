<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Expense $expense): bool
    {
    }

    public function create(User $user): Response
    {
        return $user->role === 'user'
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(User $user, Expense $expense): bool
    {
    }

    public function delete(User $user, Expense $expense): Response
    {
        return $user->id === $expense->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function restore(User $user, Expense $expense): bool
    {
    }

    public function forceDelete(User $user, Expense $expense): bool
    {
    }
}
