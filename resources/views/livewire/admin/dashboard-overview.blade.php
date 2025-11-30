<div>
    {{--Card Overview--}}
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 ">
        <div class="space-y-5 border rounded-2xl p-6 bg-white">
            <span class="flex items-center justify-between">
              <span class="px-3 py-1 rounded-lg text-emerald-700 bg-emerald-200">
                        <x-ui.icon name="ps:money-wavy" class="size-5"/>
                    </span>
                <p class="flex space-x-2">
                    <x-ui.icon name="arrow-trending-up" class="size-5 text-emerald-700"/>
                    <span class="text-xs text-emerald-700">12.5%</span>
                </p>
            </span>
            <span class="space-y-2">
                <h1 class="text-sm text-gray-500">Total Expenses</h1>
                <p class="text-2xl text-gray-800">₱241,800</p>
                <h2 class="text-xs text-gray-500">Across all users this year</h2>
            </span>
        </div>

        <div class="space-y-5 border rounded-2xl p-6 bg-white">
            <span class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-lg text-blue-700 bg-blue-200">
                        <x-ui.icon name="wallet" class="size-5"/>
                    </span>
                <p class="flex space-x-2">
                    <x-ui.icon name="arrow-trending-up" class="size-5 text-blue-700"/>
                    <span class="text-xs text-blue-700">12.5%</span>
                </p>
            </span>
            <span class="space-y-2">
                <h1 class="text-sm text-gray-500">Total Balance</h1>
                <p class="text-2xl text-gray-800">₱241,800</p>
                <h2 class="text-xs text-gray-500">Combined user wallets</h2>
            </span>
        </div>

        <div class="space-y-5 border rounded-2xl p-6 bg-white">
            <span class="flex items-center justify-between">
                   <span class="px-3 py-1 rounded-lg text-purple-700 bg-purple-200">
                        <x-ui.icon name="users" class="size-6"/>
                    </span>
                    <p class="text-xs text-purple-700">+12.5%</p>
            </span>
            <span class="space-y-2">
                <h1 class="text-sm text-gray-500">Active Users</h1>
                <p class="text-2xl text-gray-800">50</p>
                <h2 class="text-xs text-gray-500">Out of 156 total users</h2>
            </span>
        </div>

        <div class="space-y-5 border rounded-2xl p-6 bg-white">
            <span class="flex items-center justify-between">
               <span class="px-3 py-1 rounded-lg text-orange-700 bg-orange-200">
                        <x-ui.icon name="credit-card" class="size-6"/>
               </span>
                    <p class="text-xs text-orange-700">12.5%</p>
            </span>
            <span class="space-y-2">
                <h1 class="text-sm text-gray-500">Avg. Monthly Spend</h1>
                <p class="text-2xl text-gray-800">₱1,551</p>
                <h2 class="text-xs text-gray-500">Per user this month</h2>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-5 grid-rows-3 gap-8 py-6">
        {{--Top Spenders--}}
        <div class="col-span-5 row-span-2 lg:col-span-2 lg:row-span-4 border bg-white rounded-2xl p-6 space-y-5">
            <span class="flex items-center justify-between">
                <h1 class="text-gray-800 text-base">Top 5 Spenders</h1>
                <h2 class="text-gray-500 text-sm">This Month</h2>
            </span>

            <div class="bg-gray-100 py-[12px] px-6 rounded-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <span class="rounded-full bg-emerald-600 text-white text-base px-[11px] py-2">JS</span>
                        <span>
                            <h1 class="text-sm">John Smith</h1>
                            <p class="text-gray-500 text-xs">89 transactions</p>
                        </span>
                    </div>
                    <div>
                        <h1>$12,450</h1>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 py-[12px] px-6 rounded-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <span class="rounded-full bg-emerald-600 text-white text-base px-[11px] py-2">JS</span>
                        <span>
                            <h1 class="text-sm">John Smith</h1>
                            <p class="text-gray-500 text-xs">89 transactions</p>
                        </span>
                    </div>
                    <div>
                        <h1>$12,450</h1>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 py-[12px] px-6 rounded-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <span class="rounded-full bg-emerald-600 text-white text-base px-[11px] py-2">JS</span>
                        <span>
                            <h1 class="text-sm">John Smith</h1>
                            <p class="text-gray-500 text-xs">89 transactions</p>
                        </span>
                    </div>
                    <div>
                        <h1>$12,450</h1>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 py-[12px] px-6 rounded-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <span class="rounded-full bg-emerald-600 text-white text-base px-[11px] py-2">JS</span>
                        <span>
                            <h1 class="text-sm">John Smith</h1>
                            <p class="text-gray-500 text-xs">89 transactions</p>
                        </span>
                    </div>
                    <div>
                        <h1>$12,450</h1>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 py-[12px] px-6 rounded-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <span class="rounded-full bg-emerald-600 text-white text-base px-[11px] py-2">JS</span>
                        <span>
                            <h1 class="text-sm">John Smith</h1>
                            <p class="text-gray-500 text-xs">89 transactions</p>
                        </span>
                    </div>
                    <div>
                        <h1>$12,450</h1>
                    </div>
                </div>
            </div>
        </div>
        {{--Global Expense--}}
        <div class="col-span-5 row-span-2 row-start-3 lg:col-span-3 lg:row-span-4 lg:col-start-3 border bg-white rounded-2xl p-6">2</div>
    </div>
    {{--Recent Activity--}}
    <div class="bg-white rounded-2xl space-y-3 p-6">
        <div class="flex items-center gap-4">
            <div class="px-3 py-2 rounded-lg text-emerald-700 bg-emerald-200">
                <x-ui.icon name="ps:pulse" class="size-5"/>
            </div>
            <h1 class="text-base text-gray-800">Recent Activity</h1>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-pin-rows">
                <!-- head -->
                <thead>
                <tr class="text-center text-gray-600">
                    <th>User</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Time</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                <!-- row 1 -->
                <tr class="text-center">
                    <td>Admin</td>
                    <td>added category</td>
                    <td class="text-gray-500">Transportation</td>
                    <td class="text-gray-500">15 minutes ago</td>
                    <td>
                        @php
                            $type = 'create';
                        @endphp
                        @switch($type)
                            @case('create')
                                <x-ui.badge pill color="create" size="sm">create</x-ui.badge>
                            @break
                            @case('update')
                                <x-ui.badge pill color="personal" size="sm">update</x-ui.badge>
                            @break
                            @case('delete')
                                <x-ui.badge pill color="delete" size="sm">delete</x-ui.badge>
                            @break
                        @endswitch

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
