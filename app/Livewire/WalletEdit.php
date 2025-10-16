<?php

namespace App\Livewire;

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

        $validated = $this->validate();
        $this->wallet->update([
            'available_balance' => $this->current_balance,
            ... $validated
        ]);

        $this->dispatch('refreshEditWallet');
        $this->dispatch('close-modal', id: 'edit-wallet-modal');
    }

    public function render(): View
    {
        return view('livewire.wallet-edit');
    }
}
