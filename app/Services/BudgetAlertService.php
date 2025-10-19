<?php

namespace App\Services;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class BudgetAlertService
{
    public function __construct()
    {
    }

    public function getAlertForUser($user): Collection
    {
        return Category::query()->where('user_id', $user)
            ->whereColumn('spent', '>', 'monthly_budget')
            ->get();
    }

    public function hasExceeded($category): bool
    {
        return $category->spent >= $category->monthly_budget;
    }
}
