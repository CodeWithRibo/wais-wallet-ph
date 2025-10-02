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
    public ?string $search = '';
    #[Url]
    public $sort = 'created_at';
    public $sortDirection = 'ASC';

    public function sortBy($field): string
    {
        return $this->sort === $field

            ? $this->sortDirection = $this->sortDirection === 'ASC'  ? 'DESC' : 'ASC'
            : $this->sort = $field;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $sortColumn = $this->sortDirection === 'DESC' ? "-$this->sort" : $this->sort;

        $expenses = QueryBuilder::for(Expense::class)
            ->search(trim($this->search))
            ->allowedSorts(['date', 'category', 'wallet', 'payment_method'])
            ->defaultSort($sortColumn)
            //Pagination Bug
            ->paginate(15);
        return view('livewire.expense-table', compact('expenses'));
    }
}
