<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use App\Services\ToastNotificationService;
use Illuminate\View\View;
use Livewire\Component;

class CategoryForm extends Component
{
    public $category_name;
    public $monthly_budget;
    public $category_type;

    protected function rules(): array
    {
        return [
            'category_name' => 'required',
            'monthly_budget' => 'required',
            'category_type' => 'required',
        ];
    }

    public function save(): void
    {
        $this->authorize('create', Category::class);

        $validated = $this->validate();

        $category = Category::query()
            ->create(['user_id' => auth()->id(),
                'spent' => 0,
                'remaining' => 0,
                ... $validated]);

        if ($category)
            $this->dispatch('notify', ... ToastNotificationService::success('Category added successfully'));

        $this->dispatch('createCategory');
        $this->dispatch('close-modal', id: 'add-category');
    }

    public function render() : View
    {
        return view('livewire.categories.category-form');
    }
}
