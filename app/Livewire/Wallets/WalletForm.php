<?php

namespace App\Livewire\Wallets;


use App\Livewire\Concerns\HasToast;
use App\Models\Wallet;
use App\Services\ToastNotificationService;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class WalletForm extends Component
{
    use HasToast;

    #[Validate]
    public $wallet_name = '';
    public $current_balance = '';
    public $wallet_type = '';
    public $monthly_spent;
    public $transaction;

    protected function rules(): array
    {
        return [
            'wallet_name' => [
                'required',
                'max:50',
                Rule::unique('wallets')->where('user_id', auth()->id())
            ],
            'current_balance' => 'required|numeric|min:1',
            'wallet_type' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'current_balance.min' => 'The current balance field must be at least ₱1',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->wallet_name = trim($this->wallet_name);

        $this->authorize('create', Wallet::class);

        $wallet = Wallet::query()->create([
            'user_id' => auth()->id(),
            'monthly_spent' => 0,
            'transaction' => 0,
            'available_balance' => $this->current_balance,
            ... $this->validate()
        ]);

        if ($wallet) {
            $this->success('Added wallet successfully');
        }

        $this->dispatch('createWallet');
        $this->dispatch('close-modal', id: 'add-wallet');

    }

    public function render()
    {
        return view('livewire.wallets.wallet-form');
    }
}
