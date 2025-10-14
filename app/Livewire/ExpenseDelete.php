<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Wallet;
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
        $this->expense = Expense::query()->findOrFail($this->expenseId);

        $this->authorize('delete', $this->expense);
        $this->resetPage();
    }

    public function delete(): void
    {
        $this->loadExpense($this->expenseId);
        $this->expense->delete();

        $wallet = Wallet::where('wallet_name', $this->expense->wallet_type)->first();

        if ($wallet) {
            Wallet::query()
                ->where('wallet_name', $this->expense->wallet_type)
                ->update([
                    'monthly_spent' => $this->expense->amount - $wallet->monthly_spent,
                    'available_balance' => $this->expense->amount + $wallet->available_balance,
                    'transaction' => 0,
            ]);
        }


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
