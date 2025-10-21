<div class="space-y-8">
    <div class="md:flex items-center gap-4">
        <h1 class="text-gray-800 text-base font-semibold">Active Wallet: </h1>

        @php
            $wallets = \App\Models\Wallet::query()->pluck('wallet_name')->toArray();
            $indexed = array_combine(range(1, count($wallets)), $wallets);
        @endphp

        <x-select-option wire:model.live="active_wallet"
                         :options="['all' => 'All Wallets'] +  $indexed"
                         class="w-full  md:w-[50%] lg:w-[30%]">
        </x-select-option>
    </div>
    <div class="text-gray-800 text-2xl font-bold">
        Monthly Summary
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 grid-rows-1 gap-4">
        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Total Spent</p>
               <i class="fa-solid fa-peso-sign text-[18px] text-black"></i>
            </span>
            <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                    ₱{{$totalSpent ?? 0}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Total Budget</p>
                <x-ui.icon name="wallet" class="text-gray-500"/>
            </span>
            <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                    ₱{{$totalBudget ?? 0}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Remaining</p>
                <x-ui.icon name="arrow-trending-up"/>
            </span>
            <span class="">
                <h1 class="text-[#118139] font-bold text-xl">
                        ₱{{$remaining ?? 0}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Budget used</p>
                <x-ui.icon name="arrow-trending-up"/>
            </span>
            <span class="">
                <h1 class="text-[#118139] font-bold text-xl">
                        {{round($budgetProgress, 2)}}%
                </h1>
                <p class="text-gray-500 text-sm">
                    Of total budget
                </p>
            </span>
        </div>
    </div>

    <div>
        <h1 class="text-gray-800 font-semibold text-xl p-2">Category Breakdown</h1>
        <div class="grid grid-col-1 md:grid-cols-2 gap-5 relative">
            <div style="height: 300px;" class="border rounded-xl">
                <div id="walletChart"></div>
            </div>
            <div style="height: 300px;" class="border rounded-xl">
                <div id="dailyTrent"></div>
            </div>
        </div>
    </div>

    @script
    <script>
        let chart;
        let series = [];
        let labels = [];

        window.onload = () => {
            const options = {
                chart: {
                    type: 'pie',
                    height: 300
                },
                series: series,
                labels: labels,
                colors: ['#F87171', '#34D399'],
                legend: {
                    position: 'bottom'
                }
            };


            chart = new ApexCharts(document.querySelector("#walletChart"), options);
            chart.render();
        };



        Livewire.on('updateChart', data => {
            labels = data.categoryData.map(item => `${item.category_name} (${item.percentage}%)`);
            series = data.categoryData.map(item => item.spent);

            chart.updateOptions({labels: labels});
            chart.updateSeries(series);

            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 100);
        });
    </script>

    @endscript

</div>
