<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    /**
     * @throws \Throwable
     */
    public function save(): void
    {
        $validated = $this->validate();

        $this->authorize('create', Expense::class);

        try {
            DB::transaction(function () use ($validated) {
                //Fix not inserting new data
                DB::table('wallets')
                    ->where('wallet_name', $this->wallet_type)
                    ->increment('monthly_spent', floatval($this->amount));

                DB::table('wallets')
                    ->where('wallet_name', $this->wallet_type)
                    ->increment('transaction');


                $expense = Expense::query()->create([
                    'user_id' => auth()->id(),
                    'wallet_id' => auth()->id(),
                    ... $validated
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

            });
        } catch (\Throwable $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
            DB::rollBack();
        }
    }

    public function render(): View
    {
        $user = auth()->user();
        return view('livewire.expense-form', compact('user'));
    }
}
