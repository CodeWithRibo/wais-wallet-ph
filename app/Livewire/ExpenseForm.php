<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\View\View;
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

        $expense = Expense::create([
            'user_id' => auth()->id(),
            'wallet_id' => auth()->id(),
            ... $this->validate()
        ]);

        if ($expense) {
            $this->dispatch('notify',
                type: 'success',
                content: 'Expense added successfully',
                duration: 4000
            );
        } else {
            $this->dispatch('notify',
                type: 'error',
                content: 'Failed to add expense. Please try again.',
                duration: 4000
            );
        }

        $this->dispatch('close-modal', id: 'add-expense');
        $this->dispatch('expense-saved');
    }

    public function render(): View
    {
        $user = auth()->user();
        return view('livewire.expense-form', compact('user'));
    }
}
