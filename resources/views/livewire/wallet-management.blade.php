<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-1 gap-4">
    <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Total Balance</p>
               <i class="fa-solid fa-peso-sign text-[18px] text-black"></i>
            </span>
        <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                   ₱{{number_format($totalBalance, 2)}}
                </h1>
                <p class="text-gray-500 text-sm">
                    Across All wallets
                </p>
        </span>
    </div>

    <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Monthly Spending</p>
                <x-ui.icon name="arrow-trending-down" class=""/>
            </span>
        <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                    ₱{{number_format($monthlySpent, 2)}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
        </span>
    </div>


    <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Available</p>
                <x-ui.icon name="arrow-trending-up" class=""/>
            </span>
        <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                ₱{{number_format($availBal, 2)}}
                </h1>
                <p class="text-gray-500 text-sm">
                    After Expenses
                </p>
        </span>
    </div>

</div>
