<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function updated($property) : void
    {
        $this->validateOnly($property);
    }

    public function register(): void
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('login', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <div class="m-5 block text-center">
            <span class="flex items-center justify-center">
                      <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <h1 class="text-2xl sm:text-3xl">Wait Wallet PH</h1>
            </span>
            <p class="text-gray-500 text-sm">Sign in to your account</p>
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live.debounce.300ms="name" id="name"
                          class="block mt-1 w-full focus:border-green-400 focus:ring-green-400"
                          type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model.live.debounce.300ms="email" id="email"
                          class="block mt-1 w-full focus:border-green-400 focus:ring-green-400" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model.live.debounce.300ms="password" id="password"
                            class="block mt-1 w-full focus:border-green-400 focus:ring-green-400"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model.live.debounce.300ms="password_confirmation" id="password_confirmation"
                            class="block mt-1 w-full focus:border-green-400 focus:ring-green-400"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-5">
            <button class="cursor-pointer py-[8px] text-white w-full bg-emerald-500 hover:bg-emerald-600 transition-all duration-300 border-none rounded-md" type="submit">
                {{ __('Register') }}
            </button>
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="hover:underline text-sm text-emerald-500 hover:text-emerald-600 rounded-md transition-all duration-300" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

        </div>
    </form>
</div>
