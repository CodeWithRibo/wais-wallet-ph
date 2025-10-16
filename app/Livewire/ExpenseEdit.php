<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Wallet;
use App\Services\ToastNotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    public function save(): void
    {
        $validated = $this->validate();

        $originalWalletType = $this->expense->wallet_type;
        $originalAmount = $this->expense->amount;

        $walletChanged = $originalWalletType !== $validated['wallet_type'];

        $newWalletType = $validated['wallet_type'];
        $newAmount = $validated['amount'];


        try {
            DB::transaction(function () use ($walletChanged, $originalWalletType, $originalAmount, $newWalletType, $newAmount, $validated) {

                if ($walletChanged) {
                    Wallet::query()
                        ->where('wallet_name', $originalWalletType)
                        ->update([
                            'monthly_spent' => DB::raw('monthly_spent - ' . floatval($originalAmount)),
                            'available_balance' => DB::raw('available_balance + ' . floatval($originalAmount)),
                            'transaction' => DB::raw('transaction - 1 '),
                        ]);

                    Wallet::query()
                        ->where('wallet_name', $newWalletType)
                        ->update([
                            'monthly_spent' => DB::raw('monthly_spent + ' . floatval($newAmount)),
                            'available_balance' => DB::raw('available_balance - ' . floatval($newAmount)),
                            'transaction' => DB::raw('transaction + 1 '),
                        ]);
                } else {
                    $diff = $newAmount - $originalAmount;

                    if ($diff !== 0) {
                        Wallet::query()
                            ->where('wallet_name', $originalWalletType)
                            ->update([
                                'monthly_spent' => DB::raw('monthly_spent + ' . floatval($diff)),
                                'available_balance' => DB::raw('available_balance' . ($diff > 0 ? '-' : '+') . abs($diff)),
                            ]);
                    }
                }

                $this->expense->update($validated);

                $this->dispatch('refresh-table');
                $this->dispatch('update-expense', id: $this->expense->id);
                $this->dispatch('close-modal', id: 'edit-expense-modal');
                $this->dispatch('notify', ... ToastNotificationService::success('expense updated successfully'));
            });
        } catch (\Throwable $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
            DB::rollBack();
        }
    }

    public function render(): View
    {
        $user = auth()->user();
        return view('livewire.expense-edit', compact('user'));
    }
}
