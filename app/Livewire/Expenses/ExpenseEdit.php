<?php

namespace App\Livewire\Expenses;

use App\Livewire\Concerns\HasToast;
use App\Models\Category;
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
    use HasToast;

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
        $this->expense = Expense::where('user_id', auth()->id())->findOrFail($this->expenseId);

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

        $originalAmount = $this->expense->amount;
        $newAmount = $validated['amount'];

        //Wallet
        $originalWalletType = $this->expense->wallet_type;
        $walletChanged = $originalWalletType !== $validated['wallet_type'];
        $newWalletType = $validated['wallet_type'];

        //Category
        $originalCategory = $this->expense->category;
        $categoryChanged = $originalCategory !== $validated['category'];
        $newCategory = $validated['category'];



        try {
            DB::transaction(function () use (
                $walletChanged,
                $originalWalletType,
                $originalAmount,
                $newWalletType,
                $newAmount,
                $validated,
                $originalCategory,
                $categoryChanged,
                $newCategory
            ){

                if ($walletChanged) {
                    Wallet::query()
                        ->where('wallet_name', $originalWalletType)
                        ->where('user_id', auth()->id())
                        ->update([
                            'monthly_spent' => DB::raw('monthly_spent - ' . floatval($originalAmount)),
                            'available_balance' => DB::raw('available_balance + ' . floatval($originalAmount)),
                            'transaction' => DB::raw('transaction - 1 '),
                        ]);

                    Wallet::query()
                        ->where('wallet_name', $newWalletType)
                        ->where('user_id', auth()->id())
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
                            ->where('user_id', auth()->id())
                            ->update([
                                'monthly_spent' => DB::raw('monthly_spent + ' . floatval($diff)),
                                'available_balance' => DB::raw('available_balance' . ($diff > 0 ? '-' : '+') . abs($diff)),
                            ]);
                    }
                }

                if ($categoryChanged) {
                    Category::query()
                        ->where('category_name', $originalCategory)
                        ->update([
                            'spent' => DB::raw('spent - ' . floatval($originalAmount)),
                            'remaining' => DB::raw('remaining + ' . floatval($originalAmount)),
                        ]);

                    Category::query()
                        ->where('category_name', $newCategory)
                        ->update([
                            'spent' => DB::raw('spent + ' . floatval($newAmount)),
                            'remaining' => DB::raw('remaining - ' . floatval($newAmount)),
                        ]);
                } else {
                    $diff = $newAmount - $originalAmount;

                    if ($diff !== 0) {
                        Category::query()
                            ->where('category_name', $originalCategory)
                            ->update([
                                'spent' => DB::raw('spent + ' . floatval($diff)),
                                'remaining' => DB::raw('remaining' . ($diff > 0 ? '-' : '+') . abs($diff)),
                            ]);
                    }
                }


                $this->expense->update($validated);

                $this->dispatch('refresh-table');
                $this->dispatch('update-expense', id: $this->expense->id);
                $this->dispatch('close-modal', id: 'edit-expense-modal');
                $this->success('expense updated successfully');
            });
        } catch (\Throwable $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
            DB::rollBack();
        }
    }

    public function render(): View
    {
        $user = auth()->user();
        return view('livewire.expenses.expense-edit', compact('user'));
    }
}
