<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;

class ExpenseTable extends Component
{
    use WithPagination;

    #[Url]
    public ?string $search = '';
    public $sort = 'created_at';
    public $sortDirection = 'ASC';
    public $expense;
    public $storeExpense;
    #[Url]
    public $category_filter = 'All Categories';
    #[Url]
    public $wallet_filter = 'All Wallet';

    public function mount(): void
    {
        $this->expense = Expense::select(
            'amount',
            'category',
            'date',
            'wallet_type',
            'payment_method',
            'notes')->get();
    }

    #[On(['refresh-table' , 'expense-saved'])]
    public function refresh(): void
    {
        $this->resetPage();
    }

    public function edit($id): void
    {
        $this->dispatch('expense-edit', id: $id);
    }

    public function delete($id): void
    {
        $this->dispatch('expense-delete', id: $id);
    }

    #[On('delete-expense')]
    public function removeExpense($id): void
    {
        $this->expense = $this->expense->reject(fn($expense) => $expense->id === (int)$id);
    }

    #[On('update-expense')]
    public function refreshExpense($id): void
    {
        $updatedExpense = Expense::findOrFail($id);
        $this->expense = $this->expense->map(function ($t) use ($updatedExpense) {
            return $t->id === (int)$updatedExpense->id ? $updatedExpense : $t;
        });
    }

    public function sortBy($field): string
    {
        return $this->sort === $field

            ? $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC'
            : $this->sort = $field;
    }

    public function updatedWalletFilter() : void
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $sortColumn = $this->sortDirection === 'DESC' ? "-$this->sort" : $this->sort;

        $query = QueryBuilder::for(Expense::class)
            ->search(trim($this->search))
            ->allowedSorts(['date', 'category', 'wallet_type', 'payment_method'])
            ->defaultSort($sortColumn);

        if ($this->category_filter != 'All Categories') $query->where('category', $this->category_filter);
        if ($this->wallet_filter != 'All Wallet')  $query->where('wallet_type', $this->wallet_filter);

        $expenses = $query->with('categoryRelation')->paginate(15);
        $expenseCount = $query->count();

        return view('livewire.expenses.expense-table', compact(['expenses', 'expenseCount']));
    }
}
