<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {

    public $user;
    public array $routes;
    public array $active;

    /**
     * @return void
     * Routes and Active user navigation
     */
    public function mount(): void
    {
        $this->user = auth()->user();

        $this->routes = match ($this->user->role) {
            'user' =>
            [
                'dashboard' => route('dashboard'),
                'secondRoute' => route('expenses'),
                'categories' => route('categories'),
                'wallets' => route('wallets'),
            ],
            'admin' =>
            [
                'dashboard' => route('admin.dashboard'),
                'secondRoute' => route('admin.users'),
                'categories' => route('admin.categories'),
                'wallets' => route('admin.wallets'),
//                'auditLogs' => route('admin.audit-logs'),
            ],
        };

        $this->active = [
            'dashboard' => $this->user->role === 'user'
                ? request()->routeIs('dashboard')
                : request()->routeIs('admin.dashboard'),
            'secondRoute' => $this->user->role === 'user'
                ? request()->routeIs('expenses')
                : request()->routeIs('admin.users'),
            'wallets' => $this->user->role === 'user'
                ? request()->routeIs('wallets')
                : request()->routeIs('admin.wallets'),
            'categories' => $this->user->role === 'user'
                ? request()->routeIs('categories')
                : request()->routeIs('admin.categories'),
//            'auditLogs' => $this->user->role === 'admin'
//                ? request()->routeIs('admin.audit-logs')
//                : null
        ];

    }

    /**
     * @return void
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b shadow-md fixed left-0 top-0 right-0 z-40 border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{$routes['dashboard']}}" wire:navigate>
                        <x-application-logo class="block h-24 w-auto fill-current text-gray-800"/>
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-5 md:space-x-10 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="$routes['dashboard']"
                                :active="$active['dashboard']"
                                wire:navigate>
                        @if($user->role == 'user' || $user->role == 'admin')
                            Dashboard
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="$routes['secondRoute']"
                                :active="$active['secondRoute']"
                                wire:navigate>
                        {{$user->role =='user' ? 'Expenses' : 'Users'}}
                    </x-nav-link>

                    <x-nav-link :href="$routes['categories']"
                                :active="$active['categories']" wire:navigate>
                        @if($user->role == 'user' || $user->role == 'admin')
                            Categories
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="$routes['wallets']"
                                :active="$active['wallets']"
                                wire:navigate>
                        {{$user->role =='user' ? 'Wallet' : 'Wallets'}}
                    </x-nav-link>

{{--                    <x-nav-link :href="$user->role === 'admin' ? $routes['auditLogs'] : null"--}}
{{--                                :active="$user->role === 'admin' ? $active['auditLogs'] : null" wire:navigate>--}}
{{--                        {{$user->role =='admin' ? 'Audit Logs' : null}}--}}
{{--                    </x-nav-link>--}}

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-hidden transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                 x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="$routes['dashboard']" :active="$active['dashboard']" wire:navigate>
                @if($user->role == 'user' || $user->role == 'admin')
                    Dashboard
                @endif
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('expenses')" :active="request()->routeIs('expenses')" wire:navigate>
                {{$user->role =='user' ? 'Expenses' : 'Users'}}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories')" :active="request()->routeIs('categories')" wire:navigate>
                {{ __('Categories') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('wallets')" :active="request()->routeIs('wallets')" wire:navigate>
                {{ __('Wallet') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800"
                     x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                     x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
