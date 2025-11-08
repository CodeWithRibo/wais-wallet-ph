<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use App\Models\Expense;
use App\Services\ToastNotificationService;
use Illuminate\View\View;
use Livewire\Attributes\On;
use \Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryUpdate extends Component
{
    public $category_name;
    public $category_type;
    public $monthly_budget;
    public $category;


    #[On('update-category')]
    public function loadCategory($id): void
    {
        $this->category = Category::where('user_id', auth()->id())->findOrFail($id);

        $this->fill($this->category->only([
            'category_name',
            'category_type',
            'monthly_budget',
        ]));

        $this->authorize('update', $this->category);
    }

    protected function rules(): array
    {
        return [
            'category_name' => [
               'required',
                Rule::unique('categories')->ignore($this->category->id)
            ],
            'category_type' => 'required',
            'monthly_budget' => 'required',
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();
        $data = [
            'category_name' => $this->category_name,
            'category_type' => $this->category_type,
            'monthly_budget' => $this->monthly_budget,
        ];

        $this->category->fill($data);

        if ($this->category->isDirty()) {

            $expense = Expense::where('category', $this->category_name)
                ->where('user_id', auth()->id())
                ->first() ?? 0;
            $expenseAmount = $expense->amount ?? 0;

            $this->category->update([
                'remaining' => $this->monthly_budget - $expenseAmount,
            ]);

            $category = $this->category->save($validated);

            if ($category)
                $this->dispatch('notify', ... ToastNotificationService::success('Category update successfully'));
        } else {
            $this->dispatch('notify', ... ToastNotificationService::info('No changes detected'));
        }


        $this->dispatch('saved-update-category');
        $this->dispatch('close-modal', id: 'update-category-modal');

    }

    public function render(): View
    {
        return view('livewire.categories.category-update');
    }
}
