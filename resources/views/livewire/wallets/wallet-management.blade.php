<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-1 gap-4">
        <div class="w-full border border-blue-50 bg-blue-50 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-blue-600">Total Balance</p>
                <x-ui.icon name="ps:wallet" variant="bold" class="text-blue-600"/>
            </span>
            <span class="">
                <h1 class="text-blue-600 font-bold text-xl">
                   ₱{{number_format($totalBalance, 2)}}
                </h1>
                <p class="text-gray-500 text-sm">
                    Across All wallets
                </p>
            </span>
        </div>

        <div class="w-full border border-red-50 bg-red-50 rounded-xl p-6 space-y-5 relative">
                <span class="absolute -bottom-8 -right-1 p-6">
                @if($firstExpenseDate)
                        <p class="text-[10px] text-gray-500">
                    Cycle: {{\Carbon\Carbon::parse($this->cycleStart)->format('M ,d, Y')}} → {{\Carbon\Carbon::parse($this->cycleEnd)->format('M ,d, Y')}}
                    </p>
                    @endif
                </span>

            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-red-600">Monthly Spending</p>
                <x-ui.icon name="ps:trend-down" variant="bold" class="text-red-600"/>
                    </span>
            <span class="">
                        <h1 class="text-red-600 font-bold text-xl">
                            ₱{{number_format($monthlySpent, 2)}}
                        </h1>
                        <p class="text-gray-500 text-sm">
                            This month
                        </p>
                     </span>
        </div>

        <div class="w-full border border-green-50 bg-green-50 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-green-600">Available</p>
            <x-ui.icon name="ps:trend-up" variant="bold" class="text-green-600"/>
            </span>
            <span class="">
                <h1 class="font-bold text-xl text-green-600">
                ₱{{number_format($availBal, 2)}}
                </h1>
                <p class="text-gray-500 text-sm">
                    After Expenses
                </p>
            </span>
        </div>
    </div>
    <div class="mt-13">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wallet Summary
        </h2>
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-1 gap-4">
            @foreach($wallets as $wallet)
                <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-3">
                            @switch($wallet->wallet_type)
                                @case('Personal')
                                    <h1 class="text-xl">👤</h1>
                                    @break
                                @case('Business')
                                    <h1 class="text-xl">💼</h1>
                                    @break
                                @case('Shared')
                                    <h1 class="text-xl">👥</h1>
                                    @break
                            @endswitch

                            <span>
                             <h1>{{ucfirst($wallet->wallet_name)}}</h1>
                        @switch($wallet->wallet_type)
                                    @case('Personal')
                                        <x-ui.badge
                                            color="personal">{{strtolower($wallet->wallet_type)}}</x-ui.badge>
                                        @break
                                    @case('Business')
                                        <x-ui.badge
                                            color="business">{{strtolower($wallet->wallet_type)}}</x-ui.badge>
                                        @break
                                    @case('Shared')
                                        <x-ui.badge color="shared">{{strtolower($wallet->wallet_type)}}</x-ui.badge>
                                        @break
                                @endswitch
                        </span>
                        </div>
                        <div class="mt-1">
                            <x-ui.modal.trigger id="edit-wallet-modal" class="my-4">
                                <x-secondary-button class="py-1 px-2 space-x-1 " wire:click="edit({{$wallet->id}})">
                                    <x-ui.icon name="ps:note-pencil" variant="bold" class="size-4.5"/>
                                    <p class="text-[12px]">Edit</p>
                                </x-secondary-button>
                            </x-ui.modal.trigger>

                        </div>
                    </div>
                    <div class="flex justify-between">
                   <span class="text-[15px] space-y-3 text-gray-500 font-light">
                        <p>Balance</p>
                        <p>Monthly Spent</p>
                        <p>Available</p>
                        <p>Transaction</p>
                   </span>
                        <span class="space-y-3">
                        <p class="text-neutral-900 pl-3">₱{{number_format($wallet->current_balance, 2)}}</p>
                        <p class="text-red-500  pl-2">-₱{{number_format($wallet->monthly_spent, 2)}}</p>
                        <p class="text-[#409A60] pl-3 ">₱{{number_format($wallet->available_balance, 2)}}</p>
                        <p class="text-neutral-900 pl-3">{{$wallet->transaction ?? 0}}</p>
                    </span>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
