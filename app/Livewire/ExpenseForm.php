<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;

class ExpenseForm extends Component
{
    public $amount;
    public $category;
    public $date;
    public $payment_method;
    public $notes;
    public $wallet_type;

    protected function rules(): array
    {
        return [
            'amount' => 'required',
            'category' => 'required',
            'date' => 'required|date',
            'wallet_type' => 'required',
            'payment_method' => 'nullable',
            'notes' => 'nullable|max:50',

        ];
    }

    public function save()
    {
        $this->authorize('create', Expense::class);
        Expense::create([
            'user_id' => auth()->id(),
            'wallet_id' => auth()->id(),
            ... $this->validate()
        ]);
        return redirect()->route('expenses');
    }

    public function render()
    {
        return view('livewire.expense-form');
    }
}
