<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Services\UserAccountService;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Validation\Rules;

class UserForm extends Component
{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = '';


    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', Rules\Password::defaults()],
            'role' => ['required']
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function save(UserAccountService $accountService)
    {
        $validated = $this->validate();

        $accountService->createAccount($validated);

    }


    public function render(): View
    {
        return view('livewire.admin.users.user-form');
    }
}
