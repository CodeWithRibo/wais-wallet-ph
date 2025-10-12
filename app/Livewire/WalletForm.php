<?php

namespace App\Livewire;


use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class WalletForm extends Component
{
    #[Validate]
    public $wallet_name = '';
    public $current_balance = '';
    public $wallet_type = '';
    public $monthly_spent;
    public $transaction;

    protected function rules(): array
    {
        return [
            'wallet_name' => 'required|min:6|max:50',
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
       $this->authorize('create', Wallet::class);

        Wallet::query()->create([
            'user_id' => auth()->id(),
            'monthly_spent' => 0,
            'transaction' => 0,
            'available_balance' => $this->current_balance,
            ... $this->validate()
        ]);

        return redirect()->route('wallet');
    }

    public function render()
    {
        return view('livewire.wallet-form');
    }
}
