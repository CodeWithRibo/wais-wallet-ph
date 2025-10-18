<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryManagement extends Component
{

    public $totalBudget;
    public $totalSpent;
    public $totalRemaining;

    public function edit($id): void
    {
        $this->dispatch('update-category', id: $id);
    }

    #[On(['createCategory', 'saved-update-category'])]
    public function refresh()
    {

    }

    public function render(): View
    {
        $q = Category::query();

        $this->totalBudget = $q->pluck('monthly_budget')->sum() ?? 0;
        $this->totalSpent = $q->pluck('spent')->sum() ?? 0;
        $this->totalRemaining = $q->pluck('remaining')->sum() ?? 0;

        $categories = $q->select([
            'id',
            'category_name',
            'monthly_budget',
            'category_type',
            'spent',
            'remaining'
        ])->get();

        return view('livewire.categories.category-management', compact('categories'));
    }
}
