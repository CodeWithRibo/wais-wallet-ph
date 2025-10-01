<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;

class ExpenseTable extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';
    #[Url]
    public $sort = 'created_at';
    public $sortDirection = 'ASC';

    public function sortBy($field): string
    {
        return $this->sort === $field

            ? $this->sortDirection = $this->sortDirection === 'ASC'  ? 'DESC' : 'ASC'
            : $this->sort = $field;
    }

    public function render()
    {
        $sortColumn = $this->sortDirection === 'DESC' ? "-$this->sort" : $this->sort;

        $expenses = QueryBuilder::for(Expense::class)
            ->allowedSorts(['date', 'category', 'wallet', 'payment_method'])
            ->defaultSort($sortColumn)
            ->paginate(10);

        return view('livewire.expense-table', compact('expenses'));
    }
}
