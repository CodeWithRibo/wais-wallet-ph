<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseDelete extends Component
{
    use WithPagination;

    public $expenseId;
    public $expense;

    #[On('expense-delete')]
    public function loadExpense($id): void
    {
        $this->expenseId = $id;
        $this->expense = Expense::findOrFail($this->expenseId);

        $this->authorize('delete', $this->expense);
        $this->resetPage();
    }

    public function delete(): void
    {
        $this->loadExpense($this->expenseId);
        $this->expense->delete();

        DB::table('wallets')
            ->where('wallet_name', $this->expense->wallet_type)
            ->decrement('transaction');

        $this->dispatch('close-modal', id: 'delete-expense-modal');
        $this->dispatch('delete-expense', ['id' => $this->expenseId]);
        $this->dispatch('notify',
            type: 'success',
            content: 'expense deleted successfully',
            duration: 3000
        );
    }

    public function render(): View
    {
        return view('livewire.expense-delete');
    }
}
