@extends('layouts.app')
@section('content')
    <div class="py-12 pt-20 space-y-10 bg-white ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6  space-y-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Wais Wallet PH
                    </h2>
                    <p class="text-gray-500">
                        Track your expenses, manage budgets, and achieve your financial goals
                    </p>
                </div>
                <div class="p-6 space-y-2">
                    @livewire('wallets.wallet-switcher')
                </div>

            </div>
        </div>
    </div>
@endsection
