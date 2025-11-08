<?php

namespace App\Livewire\Expenses;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Wallet;
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
        $this->expense = Expense::where('user_id', auth()->id())->findOrFail($this->expenseId);

        $this->authorize('delete', $this->expense);
        $this->resetPage();
    }

    public function delete(): void
    {

        $wallet = Wallet::where('wallet_name', $this->expense->wallet_type)->first();
        $category = Category::where('category_name', $this->expense->category)->first();

        if ($wallet) {
            Wallet::query()
                ->where('wallet_name', $this->expense->wallet_type)
                ->update([
                    'monthly_spent' =>  $wallet->monthly_spent - $this->expense->amount,
                    'available_balance' => $wallet->available_balance + $this->expense->amount,
                    'transaction' => 0,
            ]);
        }

        if ($category) {
            Category::query()
            ->where('category_name', $this->expense->category)
                ->update([
                    'spent' => $category->spent - $this->expense->amount,
                    'remaining' => $category->remaining +  $this->expense->amount,
                ]);
        }

        $this->loadExpense($this->expenseId);
        $this->expense->delete();

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
        return view('livewire.expenses.expense-delete');
    }
}
