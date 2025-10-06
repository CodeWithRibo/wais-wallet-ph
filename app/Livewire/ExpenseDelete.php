<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;

class ExpenseDelete extends Component
{
    public $id;
    public $expense;

    public function mount($id): void
    {
        $this->id = $id;
        $this->expense = Expense::findOrFail($this->id);
    }

    public function delete()
    {
        $this->authorize('delete', $this->expense);
        $this->expense->delete();
        return redirect()->route('expenses');
    }

    public function render()
    {
        return view('livewire.expense-delete');
    }
}
