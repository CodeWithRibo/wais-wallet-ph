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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div style="height: 300px;" class="border rounded-xl">
            <div id="walletChart" wire:ignore></div>
        </div>
        <div style="height: 300px;" class="border rounded-xl">
            <div id="dailyTrend" wire:ignore></div>
        </div>
    </div>


    @script
    <script>
        let pieChart, trendChart;

        function ensurePieChart() {
            const el = document.querySelector('#walletChart');
            if (!el) return;
            if (!pieChart || pieChart.el !== el) {
                pieChart = new ApexCharts(el, {
                    chart: { type: 'pie', height: 300 },
                    series: [0],
                    labels: ['No data'],
                    title: { text: 'Category Breakdown', align: 'left' },
                    colors: ['#F87171', '#34D399'],
                    legend: { position: 'bottom' }
                });
                pieChart.render();
            }
        }

        function ensureTrendChart() {
            const el = document.querySelector('#dailyTrend');
            if (!el) return;
            if (!trendChart || trendChart.el !== el) {
                trendChart = new ApexCharts(el, {
                    series: [{ name: 'Spent', data: [] }],
                    chart: { height: 300, type: 'line', zoom: { enabled: false } },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'straight' },
                    title: { text: 'Daily Spending Trend', align: 'left' },
                    grid: { row: { colors: ['#f3f3f3', 'transparent'], opacity: 0.5 } },
                    xaxis: { categories: [] }
                });
                trendChart.render();
            }
        }

        document.addEventListener('livewire:load', () => {

            ensurePieChart();
            ensureTrendChart();
        });

        Livewire.on('updateChart', (data) => {
            const items = Array.isArray(data?.categoryData) ? data.categoryData : [];

            ensurePieChart();
            ensureTrendChart();

            const hasData = items.some(i => Number(i.spent) > 0);
            const pieLabels = hasData ? items.map(i => `${i.category_name} (${i.percentage}%)`) : ['No data'];
            const pieSeries = hasData ? items.map(i => Number(i.spent) || 0) : [0];

            if (pieChart) {
                pieChart.updateOptions({ labels: pieLabels });
                pieChart.updateSeries(pieSeries);
            }

            const trendData = items.map(i => Number(i.spent) || 0);
            const trendLabels = items.map(i => i.date ?? i.day ?? i.category_name ?? '');
            if (trendChart) {
                trendChart.updateOptions({ xaxis: { categories: trendLabels } });
                trendChart.updateSeries([{ name: 'Spent', data: trendData }]);
            }

            setTimeout(() => window.dispatchEvent(new Event('resize')), 50);
        });
    </script>
    @endscript


</div>
