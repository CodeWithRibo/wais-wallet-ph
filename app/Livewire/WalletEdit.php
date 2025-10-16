<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Wallet;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class WalletEdit extends Component
{
    public $wallet_name = '';
    public $current_balance = '';
    public $wallet_type = '';
    public $wallet;


    #[On('edit-wallet')]
    public function loadWallet($id): void
    {

        $this->wallet = Wallet::query()->findOrFail($id);

        $this->fill($this->wallet->only([
            'wallet_name',
            'current_balance',
            'wallet_type',
        ]));
    }

    protected function rules(): array
    {
        return [
            'wallet_name' => [
                'required',
                Rule::unique('wallets')->ignore($this->wallet->id)
            ],
            'current_balance' => 'required',
            'wallet_type' => 'required',
        ];
    }

    public function updateWallet(): void
    {
        $expense = Expense::where('wallet_type', $this->wallet_type)->first() ?? 0;
        $expenseAmount = $expense->amount ?? 0;

        $validated = $this->validate();

        $availBal = $this->current_balance - $expenseAmount;

        if ($availBal <= $expenseAmount) {
            $this->dispatch('notify',
                type: 'error',
                content: 'Insufficient available balance',
                duration: 4000
            );
        } else {
            $data = [
                'wallet_name' => $this->wallet_name,
                'current_balance' => $this->current_balance,
                'wallet_type' => $this->wallet_type,
            ];
            $this->wallet->fill($data);

            if ($this->wallet->isDirty()) {

                $this->wallet->update([
                    'available_balance' => $this->current_balance - $expenseAmount,
                ]);

                $this->wallet->save($validated);

                $this->dispatch('notify',
                    type: 'success',
                    content: 'Wallet updated successfully',
                    duration: 4000
                );

            } else {
                $this->dispatch('notify',
                    type: 'info',
                    content: "No changes detected",
                    duration: 4000
                );
            }

        }

        $this->dispatch('refreshEditWallet');
        $this->dispatch('close-modal', id: 'edit-wallet-modal');
    }

    public function render(): View
    {
        return view('livewire.wallet-edit');
    }
}
