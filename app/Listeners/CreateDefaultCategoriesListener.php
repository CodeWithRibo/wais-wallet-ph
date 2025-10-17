<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateDefaultCategoriesListener
{
    public function __construct()
    {
    }

    public function handle(Registered $event): void
    {
        $user = $event->user;

        $defaultCategories = [
            [
                'category_name' => 'Rent/Mortgage',
                'category_type' => 'Essential',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Utilities',
                'category_type' => 'Essential',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Groceries',
                'category_type' => 'Essential',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Transportation',
                'category_type' => 'Essential',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Healthcare',
                'category_type' => 'Essential',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Dining Out',
                'category_type' => 'Lifestyle',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Entertainment',
                'category_type' => 'Lifestyle',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Shopping',
                'category_type' => 'Lifestyle',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Fitness & Gym',
                'category_type' => 'Lifestyle',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'School Supplies',
                'category_type' => 'Work & Business',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Professional Development',
                'category_type' => 'Work & Business',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Emergency Fund',
                'category_type' => 'Savings & Investments',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Investments',
                'category_type' => 'Savings & Investments',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Pet Food',
                'category_type' => 'Pet Expenses',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
            [
                'category_name' => 'Pet Healthcare',
                'category_type' => 'Pet Expenses',
                'monthly_budget' => 1000,
                'spent' => 0,
                'remaining' => 0,
            ],
        ];
            foreach ($defaultCategories as $category) {
                $user->category()->create($category);
            }

    }
}
