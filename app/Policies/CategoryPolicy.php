<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Category $category): bool
    {
    }

    public function create(User $user) : Response
    {
        return $user->role === 'user'
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(User $user, Category $category): bool
    {
    }

    public function delete(User $user, Category $category): bool
    {
    }

    public function restore(User $user, Category $category): bool
    {
    }

    public function forceDelete(User $user, Category $category): bool
    {
    }
}
