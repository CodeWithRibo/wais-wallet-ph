<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class WalletForm extends Component
{
    public $wallet_name;
    public $current_balance;
    public $wallet_type;

    protected function rules(): array
    {
        return [
            'wallet_name' => 'required|min:6|max:50',
            'current_balance' => 'required',
            'wallet_type' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $q = Wallet::query();
        $q->create([
            'user_id' => auth()->id(),
            ... $this->validate()
        ]);

        return redirect()->route('wallet');
    }



    public function render()
    {
        return view('livewire.wallet-form');
    }
}
