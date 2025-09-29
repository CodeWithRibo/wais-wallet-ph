<?php

namespace App\Livewire;
use App\Models\Expense;
use Livewire\Component;

class ExpenseTable extends Component
{
    public function render()
    {
        $expenses = Expense::orderBy('created_at', 'ASC')->paginate(10);
        return view('livewire.expense-table', compact('expenses'));
    }
}
