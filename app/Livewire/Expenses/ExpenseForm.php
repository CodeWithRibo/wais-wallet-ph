<?php

namespace App\Livewire\Expenses;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Wallet;
use App\Services\ToastNotificationService;
use Carbon\Carbon;
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

    public function mount() : void
    {
        $this->date =  Carbon::now()->format('Y-m-d');
    }
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

        $wallet = Wallet::query()->where('wallet_name', $this->wallet_type)->first();
        $category = Category::query()->where('category_name', $this->category)->first();

        try {
            DB::transaction(function () use ($validated, $wallet, $category) {

                DB::table('wallets')
                    ->where('wallet_name', $this->wallet_type)
                    ->update([
                        'monthly_spent' => DB::raw('monthly_spent + ' . floatval($this->amount)),
                        'available_balance' => DB::raw('available_balance - ' . floatval($this->amount)),
                        'transaction' => DB::raw('transaction + 1 '),
                    ]);

                DB::table('categories')
                    ->where('category_name', $this->category)
                    ->update([
                        'spent' => DB::raw('spent + ' . floatval($this->amount)),
                        'remaining' => DB::raw('remaining - ' . floatval($this->amount)),
                    ]);

               $expense = Expense::query()->create([
                    'user_id' => auth()->id(),
                    'wallet_id' => $wallet?->id,
                    'category_id' => $category?->id,
                    ... $validated
                ]);

                if ($expense)
                    $this->dispatch('notify', ... ToastNotificationService::success('Expense added successfully'));
                else
                    $this->dispatch('notify', ... ToastNotificationService::error('Failed to add expense. Please try again.'));

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
        return view('livewire.expenses.expense-form', compact('user'));
    }
}
