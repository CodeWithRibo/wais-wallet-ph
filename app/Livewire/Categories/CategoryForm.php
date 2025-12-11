<?php

namespace App\Livewire\Categories;

use App\Livewire\Concerns\HasToast;
use App\Models\Category;
use App\Services\ToastNotificationService;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class CategoryForm extends Component
{
    use HasToast;

    public $category_name;
    public $monthly_budget;
    public $category_type;
    public $categoryId;
    public function mount()
    {
        $this->categoryId = auth()->id();
    }


    protected function rules(): array
    {
        return [
            'category_name' => [
                'required',
                Rule::unique('categories')->ignore($this->categoryId)
            ],
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
                'remaining' => $this->monthly_budget,
                ... $validated]);

        if ($category)
            $this->success('Category added successfully');

        $this->dispatch('createCategory');
        $this->dispatch('close-modal', id: 'add-category');
    }

    public function render(): View
    {
        return view('livewire.categories.category-form');
    }
}
