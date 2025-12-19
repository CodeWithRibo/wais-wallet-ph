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
                    <span class="text-xs text-emerald-700">{{$totalExpensePercentage ?? 0}}%</span>
                </p>
            </span>
            <span class="space-y-2">
                <h1 class="text-sm text-gray-500">Total Expenses</h1>
                <p class="text-2xl text-gray-800">₱{{number_format($totalExpense, 2) ?? 0}}</p>
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
                <p class="text-2xl text-gray-800">₱{{number_format($this->totalBalance, 2) ?? 0}}</p>
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
                <p class="text-2xl text-gray-800">{{$activeUsers ?? 0}}</p>
                <h2 class="text-xs text-gray-500">Out of {{$totalUser ?? 0}} total users</h2>
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
                <p class="text-2xl text-gray-800">₱{{number_format($average, 2) ?? 0}}</p>
                <h2 class="text-xs text-gray-500">Per user this month</h2>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-5 grid-rows-3 gap-8 py-6">
        {{--Top Spenders--}}
        <div class="col-span-5 row-span-2 lg:col-span-2 lg:row-span-4 border bg-white rounded-2xl p-6 space-y-5">
            <span class="flex items-center justify-between">
                <div>
                    <h1 class="text-gray-800 text-base">Top 5 Spenders</h1>
                    <h3 class="text-xs text-gray-500">The top spenders only show ₱5,000 above spent</h3>
                </div>
                <h2 class="text-gray-500 text-sm">This Month</h2>
            </span>
            @if($this->topSpenders->isNotEmpty())
                @foreach($this->topSpenders as $spender)
                    <div class="bg-gray-100 py-[12px] px-6 rounded-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-3">
                        <span class="rounded-full bg-emerald-600 text-white text-base px-[13px] py-2">
                             {{substr(strtoupper($spender->user->name), 0, 1)}}
                           </span>
                                <span>
                            <h1 class="text-sm">{{$spender->user->name}}</h1>
                            <p class="text-gray-500 text-xs">{{$spender->transaction ?? 0}} transactions</p>
                        </span>
                            </div>
                            <div>
                                <h1>₱{{number_format($spender->monthly_spent, 2) ?? 0}}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-gray-500">No Top Spenders found</h1>
            @endif
        </div>
        {{-- Global Expense Chart Container --}}
        <div
            class="col-span-5 row-span-2 row-start-3 lg:col-span-3 lg:row-span-4 lg:col-start-3 border bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-700 mb-4">Global Expenses (Last 12 Months)</h3>
                <span class="mb-4 text-green-600 text-base"><span class="text-gray-500 text-sm">Total Annual:</span> ₱{{number_format($totalExpense, 2) ?? 0}}</span>
            </div>
            <div class="relative h-72 w-full">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('livewire:initialized', () => {

                    const ctx = document.getElementById('expenseChart');


                    if (window.myExpenseChart) window.myExpenseChart.destroy();

                    window.myExpenseChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($expenseLabels),
                            datasets: [{
                                label: 'Total Expense',
                                data: @json($expenseData),
                                backgroundColor: 'rgb(209,250,229)',
                                borderColor: 'rgb(81,232,155)',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function (value) {
                                            return '₱' + value;
                                        }
                                    }
                                },
                                x: {
                                    grid: {display: false}
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {

                                        label: function (context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.y !== null) {
                                                label += new Intl.NumberFormat('en-PH', {
                                                    style: 'currency',
                                                    currency: 'PHP'
                                                }).format(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });

                });
            </script>
        @endpush
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
