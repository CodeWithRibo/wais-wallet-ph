<div class="space-y-8">
    <div class="sm:flex items-center gap-4">
        <h1 class="text-gray-800 text-base font-semibold">Active Wallet: </h1>

        <x-ui.select
            class="w-full sm:w-[40%] pt-3 sm:pt-0"
            placeholder="Select Wallet"
            wire:model.live="wallet_option">
            <x-ui.select.option value="all">All</x-ui.select.option>
            <x-ui.select.option value="personal">Personal</x-ui.select.option>
            <x-ui.select.option value="business">Business</x-ui.select.option>
            <x-ui.select.option value="shared">Shared</x-ui.select.option>
        </x-ui.select>

    </div>
    <x-secondary-button wire:click="$dispatch('openModal', {component: ''})">Add Income</x-secondary-button>
    <div class="text-gray-800 text-2xl font-bold">
        Monthly Summary
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-1 gap-4">
        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Total Spent</p>
                <flux:icon.currency-dollar class="text-gray-500"></flux:icon.currency-dollar>
            </span>
            <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                    ₱100000
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Total Budget</p>
               <i class="fa-solid fa-peso-sign text-gray-500"></i>
            </span>
            <span class="">
                <h1 class="text-gray-800 font-bold text-xl">
                    ₱100000.00
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>

        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Remaining</p>
                <flux:icon.arrow-trending-up class="text-[#118139] font-semibold"></flux:icon.arrow-trending-up>
            </span>
            <span class="">
                <h1 class="text-[#118139] font-bold text-xl">
                    ₱{{$remainingBalance}}
                </h1>
                <p class="text-gray-500 text-sm">
                    This month
                </p>
            </span>
        </div>
    </div>

    <div>
        <h1 class="text-gray-800 font-semibold text-xl p-2">Category Breakdown</h1>
        <div class="grid grid-col-1 md:grid-cols-2 gap-5 relative">
            <div style="height: 300px;" class="border rounded-xl">
                <canvas id="myChart"></canvas>
            </div>
            <div style="height: 300px;" class="border rounded-xl">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');
        const ctx2 = document.getElementById('myChart2');

        const pieData = {
            // labels: ['Facilities', 'Faculty', 'Admission', 'Cashier', 'Registrar'],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100, 40, 70],
                backgroundColor: [
                    '#9CA3AF',
                    '#93C5FD',
                    '#A5B4FC',
                    '#FCD34D',
                    '#CBD5E1',
                ],
                hoverOffset: 4,
            }]
        };

        const lineData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: pieData,
            options: {
                maintainAspectRatio: false,
            }
        });

        new Chart(ctx2, {
            type: 'line',
            data: lineData,
            options: {
                maintainAspectRatio: false,
            }
        });
    </script>

</div>
