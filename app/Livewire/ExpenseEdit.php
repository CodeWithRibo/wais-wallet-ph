<?php

namespace App\Livewire;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ExpenseEdit extends Component
{
    public $id;
    public $amount;
    public $category;
    public $date;
    public $payment_method;
    public $notes;
    public $wallet_type;
    public $expense;
    public $expenseId;

    #[On('expense-edit')]
    public function loadExpense($id) : void
    {
        $this->expenseId = $id;
        $this->expense = Expense::findOrFail($this->expenseId);

        $this->fill($this->expense->only([
            'amount',
            'category',
            'date',
            'payment_method',
            'notes',
            'wallet_type',
        ]));

        $this->date = Carbon::parse($this->expense->date)->format('Y-m-d');

        $this->authorize('update', $this->expense);
    }


    /**
     * @return string[]
     */
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


    /**
     * @return void
     * @throws \Throwable
     */
    public function save() : void
    {
       DB::transaction(function () {
           $originalWalletType = $this->expense->wallet_type;

           $this->expense->update($this->validate());

           DB::table('wallets')
               ->where('wallet_name', $originalWalletType)
               ->decrement('transaction');

           $newWalletType = $this->expense->wallet_type;

           DB::table('wallets')
               ->where('wallet_name', $newWalletType)
               ->increment('transaction');

           $this->dispatch('refresh-table');
           $this->dispatch('update-expense', id : $this->expense->id);
           $this->dispatch('close-modal', id: 'edit-expense-modal');
           $this->dispatch('notify',
               type: 'success',
               content:'expense updated successfully',
               duration: 3000
           );
       });
    }

    public function render() : View
    {
        $user = auth()->user();
        return view('livewire.expense-edit', compact('user'));
    }
}
