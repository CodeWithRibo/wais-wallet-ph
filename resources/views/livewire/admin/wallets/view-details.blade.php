<x-ui.modal
    id="view-details"
    position="center"
    heading="Personal Expenses"
    description="Personal Wallet"
    width="4xl"
>
    {{--Wallet Transcation Card Overall--}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 ">
        <div class="border rounded-xl bg-gradient-to-br from-emerald-500 via-emerald-400 to-emerald-300 py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-white text-sm mt-2 ">Current Balance</h1>
                    <x-ui.icon name="ps:money-wavy" variant="bold" class="text-white size-5"/>
                </div>
                    <p class="text-xl mb-2 text-white font-semibold">₱5,420.5</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Income</h1>
                    <x-ui.icon name="ps:trend-up" class="text-emerald-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">₱38,450</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Expense</h1>
                    <x-ui.icon name="ps:trend-down" class="text-red-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">$651.09</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Transactions</h1>
                    <x-ui.icon name="ps:coins" class="text-blue-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">10</p>
            </span>
        </div>
    </div>

    <div class="my-5">
        <x-ui.badge pill color="archive">
            <x-ui.icon name="ps:users" class="size-4 mr-2"/>
            <span class="text-gray-500">Owner: </span>
            <h1>John Smith</h1>
        </x-ui.badge>
    </div>

    <div class="w-full border border-gray-100  duration-200"></div>
        <h1 class="my-5">Transaction History</h1>
    <section class="space-y-2">
        <div class="flex items-center justify-between border-none bg-gray-100 hover:bg-gray-200 transition-all   py-2 px-3  rounded-lg  ">
            <div class="flex items-center space-x-3">
        <span class="p-3 bg-red-100 rounded-xl">
            <x-ui.icon name="ps:trend-down"  class="text-red-500 size-6"/>
        </span>
                <span class="space-y-1">
              <h1 class="text-gray-800 text-base">Grocery Shopping</h1>
            <span>
                <span class="flex items-center gap-2">
                    <x-ui.icon name="ps:calendar" class="size-4"/>
                    <p class="text-xs text-gray-500">2025-11-16 14:30</p>
                </span>
                <span class="flex items-center gap-2">
                    <x-ui.icon name="ps:tag" class="size-4"/>
                    <p class="text-xs text-gray-500">Groceries</p>
                </span>
            </span>
        </span>
            </div>
            <div>
                <h1>$125.5</h1>
            </div>
        </div>
        <div class="flex items-center justify-between border-none bg-gray-100 hover:bg-gray-200 transition-all   py-2 px-3  rounded-lg  ">
            <div class="flex items-center space-x-3">
        <span class="p-3 bg-red-100 rounded-xl">
            <x-ui.icon name="ps:trend-down"  class="text-red-500 size-6"/>
        </span>
                <span class="space-y-1">
              <h1 class="text-gray-800 text-base">Grocery Shopping</h1>
            <span>
                <span class="flex items-center gap-2">
                    <x-ui.icon name="ps:calendar" class="size-4"/>
                    <p class="text-xs text-gray-500">2025-11-16 14:30</p>
                </span>
                <span class="flex items-center gap-2">
                    <x-ui.icon name="ps:tag" class="size-4"/>
                    <p class="text-xs text-gray-500">Groceries</p>
                </span>
            </span>
        </span>
            </div>
            <div>
                <h1>$125.5</h1>
            </div>
        </div>
    </section>
</x-ui.modal>
