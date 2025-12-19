<div class="space-y-8">
    <div class="text-gray-800 text-2xl font-bold">
        Monthly Summary
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 grid-rows-1 gap-4">
        <div class="w-full border border-red-50 bg-red-50 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-red-600">Total Spent</p>
                <x-ui.icon name="ps:trend-down" variant="bold" class="text-red-600"/>
            </span>
            <span class="">
                <h1 class="text-red-600 font-bold text-xl">
                    ₱{{number_format($totalSpent, 2) ?? 0}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-blue-50 bg-blue-50 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-blue-600">Total Budget</p>
               <x-ui.icon name="ps:wallet" variant="bold" class="text-blue-600"/>
            </span>
            <span class="">
                <h1 class="text-blue-600 font-bold text-xl">
                    ₱{{number_format($totalBudget, 2) ?? 0}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-green-50 bg-green-50 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-green-600">Remaining Budget</p>
                <x-ui.icon name="ps:trend-up" variant="bold" class="text-green-600"/>
            </span>
            <span class="">
                <h1 class="text-green-600 font-bold text-xl">
                        ₱{{number_format($remaining, 2) ?? 0}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div @class([
                'border-green-50 bg-green-50' => $this->budgetProgress <= 49.9,
                'border-yellow-50 bg-yellow-50' => $this->budgetProgress >= 50.0 && $this->budgetProgress <= 79.9,
                'border-red-50 bg-red-50' => $this->budgetProgress >= 80.0,
                 'w-full border rounded-xl p-6 space-y-5'])>
            <span class="flex items-center justify-between ">
                <p
                @class([ 'text-green-600' => $this->budgetProgress <= 49.9,
                'text-yellow-600' => $this->budgetProgress >= 50.0 && $this->budgetProgress <= 79.9,
                'text-red-600' => $this->budgetProgress >= 80.0,
                'text-sm font-semibold '])
                >Budget used</p>
                <x-ui.icon name="ps:trend-up" variant="bold" @class([ 'text-green-600' => $this->budgetProgress <= 49.9,
                'text-yellow-600' => $this->budgetProgress >= 50.0 && $this->budgetProgress <= 79.9,
                'text-red-600' => $this->budgetProgress >= 80.0,
                'size-6'])/>
            </span>
            <span>
                <h1
                @class([ 'text-green-600' => $this->budgetProgress <= 49.9,
                'text-yellow-600' => $this->budgetProgress >= 50.0 && $this->budgetProgress <= 79.9,
                'text-red-600' => $this->budgetProgress >= 80.0,
                'font-bold text-xl'])>
                        {{round($budgetProgress, 2)}}%
                </h1>
                <p class="text-gray-500 text-sm">
                    Of total budget
                </p>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div style="height: 350px;" class="border rounded-xl p-5">
            <div id="walletChart" wire:ignore></div>
        </div>
        <div style="height: 350px;" class="border rounded-xl p-5">
            <div id="dailyTrend" wire:ignore></div>
        </div>
    </div>


    @script
    <script>
        let pieChart, trendChart;
        let colors = [];
        const categoryColorMap = {
            'Rent': '#93C5FD',
            'Utilities': '#FCD34D',
            'Groceries': '#A7F3D0',
            'Transportation': '#FCA5A5',
            'Healthcare': '#C4B5FD',
            'Dining Out': '#F9A8D4',
            'Entertainment': '#FDBA74',
            'Shopping': '#6EE7B7',
            'Fitness & Gym': '#A5B4FC',
            'School Supplies': '#FDE68A',
            'Professional Development': '#BFDBFE',
            'Emergency Fund': '#10B981',
            'Investments': '#4ADE80',
            'Pet Food': '#FCA5A5',
            'Pet Healthcare': '#F87171'
        };


        function ensurePieChart() {
            const el = document.querySelector('#walletChart');
            if (!el) return;
            if (!pieChart || pieChart.el !== el) {
                pieChart = new ApexCharts(el, {
                    chart: {type: 'pie', height: 300},
                    series: [0],
                    labels: ['No data'],
                    title: {text: 'Category Breakdown', align: 'left'},
                    colors: ['#D1D5DB'],
                    legend: {position: 'bottom'},
                    states: {
                        hover: {
                            filter: {
                                type: 'none'
                            }
                        }
                    }
                });
                pieChart.render();
            }
        }

        function ensureTrendChart() {
            const el = document.querySelector('#dailyTrend');
            if (!el) return;
            if (!trendChart || trendChart.el !== el) {
                trendChart = new ApexCharts(el, {
                    series: [{name: 'Spent', data: []}],
                    chart: {height: 300, type: 'line', zoom: {enabled: false}},
                    dataLabels: {enabled: false},
                    stroke: {curve: 'straight'},
                    title: {text: 'Daily Spending Trend', align: 'left'},
                    grid: {row: {colors: ['#f3f3f3', 'transparent'], opacity: 0.5}},
                    xaxis: {categories: []}
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

            const colors = data.categoryData.map(item => {
                return categoryColorMap[item.category_name] || '#D1D5DB';
            });
            const hasData = items.some(i => Number(i.spent) > 0);
            const pieLabels = hasData ? items.map(i => `${i.category_name} (${i.percentage}%)`) : ['No data'];
            const pieSeries = hasData ? items.map(i => Number(i.spent) || 0) : [0];


            if (pieChart) {
                pieChart.updateOptions({labels: pieLabels, colors: colors});
                pieChart.updateSeries(pieSeries);
            }

            const trendData = items.map(i => Number(i.spent) || 0);
            const trendLabels = items.map(i => i.date ?? i.day ?? i.category_name ?? '');
            if (trendChart) {
                trendChart.updateOptions({xaxis: {categories: trendLabels}});
                trendChart.updateSeries([{name: 'Spent', data: trendData}]);
            }

            setTimeout(() => window.dispatchEvent(new Event('resize')), 50);
        });
    </script>
    @endscript


</div>
