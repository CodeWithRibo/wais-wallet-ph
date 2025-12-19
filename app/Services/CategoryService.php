<?php

namespace App\Services;

use App\Livewire\Concerns\HasToast;
use App\Models\Category;

class CategoryService
{
    use HasToast;

    public function __construct()
    {
    }

    public function createCategory($validated, $user = null)
    {
        $category = Category::query()
            ->create(['user_id' => $user,
                'spent' => 0,
                'remaining' => 0,
                ... $validated]);

        if ($category)
            $this->success('Category added successfully');
    }
}
