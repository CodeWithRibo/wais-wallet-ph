<?php

namespace App\Livewire;

use App\Models\Category;
use App\Services\BudgetAlertService;
use Livewire\Component;

class BudgetAlert extends Component
{
    public $budgetAlerts;
    public $isExceeded;
    public $exceededCount;

    public function mount(BudgetAlertService $budgetAlertService) : void
    {
        $this->budgetAlerts = $budgetAlertService->getAlertForUser(auth()->id());
        $this->exceededCount = $this->budgetAlerts->count();

        $categories = Category::query()->where('user_id', auth()->id())->get();

        $this->isExceeded = $categories->contains(fn($cat) => $budgetAlertService->hasExceeded($cat));

    }

    public function render()
    {
        return view('livewire.budget-alert');
    }
}
