<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')]
class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        return redirect()->route(
            match (Auth::user()->role) {
                'user' => 'dashboard',
                'admin' => 'admin.dashboard'
            }
        );
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form wire:submit="login">
        <div class="m-5 block text-center">
            <span class="flex items-center justify-center">
                      <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <h1 class="text-2xl sm:text-3xl">Wait Wallet PH</h1>
            </span>
            <p class="text-gray-500 text-sm">Sign in to your account</p>
        </div>
        <!-- Email Address -->
        <div class="">
            <x-input-label for="email" :value="__('Email Address')"/>
            <x-text-input wire:model.live.debounce.250ms="form.email"
                          id="email"
                          class="block mt-1 w-full focus:border-green-400 focus:ring-green-400"
                          type="email" name="email"
                          required
                          placeholder="juandelacruz@gmail.com"/>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input wire:model.live.debounce.300m="form.password" id="password"
                          class="block mt-1 w-full focus:border-green-400 focus:ring-green-400"
                          type="password"
                          name="password"
                          required autocomplete="current-password"
                          placeholder="******"/>

            <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
        </div>

        <div class="mt-5">
            <button class="cursor-pointer py-[8px] text-white w-full bg-emerald-500 hover:bg-emerald-600 transition-all duration-300 border-none rounded-md" type="submit">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-emerald-500 hover:text-emerald-600 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center space-x-2 mt-5">
            <h1 class="text-base text-gray-500">Don't have an account? </h1>
            <a href="{{route('register')}}" class="text-sm text-emerald-500 hover:text-emerald-600 hover:underline">Sign up now</a>
        </div>
    </form>
</div>
