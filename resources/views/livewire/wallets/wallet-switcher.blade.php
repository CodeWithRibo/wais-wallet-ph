<div class="space-y-8">
    <div class="md:flex items-center gap-4">
        <h1 class="text-gray-800 text-base font-semibold">Active Wallet: </h1>

        <x-select-option wire:model="wallet_option"
                         :options="['All Wallet ' => 'All Wallet', 'Personal' => 'Personal','Business' => 'Business', 'Shared' => 'Shared']"
                         class="w-full  md:w-[50%] lg:w-[30%]">
        </x-select-option>
    </div>
    <div class="text-gray-800 text-2xl font-bold">
        Monthly Summary
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-rows-1 gap-4">
        <div class="w-full border border-gray-300 rounded-xl p-6 space-y-5">
            <span class="flex items-center justify-between ">
                <p class="text-sm font-semibold text-gray-800">Total Spent</p>
               <i class="fa-solid fa-peso-sign text-[18px] text-black"></i>
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
                <x-ui.icon name="wallet" class="text-gray-500"/>
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
                <x-ui.icon name="arrow-trending-up"/>
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

{{--    <script>--}}
{{--        const ctx = document.getElementById('myChart');--}}
{{--        const ctx2 = document.getElementById('myChart2');--}}

{{--        const pieData = {--}}
{{--            // labels: ['Facilities', 'Faculty', 'Admission', 'Cashier', 'Registrar'],--}}
{{--            datasets: [{--}}
{{--                label: 'My First Dataset',--}}
{{--                data: [300, 50, 100, 40, 70],--}}
{{--                backgroundColor: [--}}
{{--                    '#9CA3AF',--}}
{{--                    '#93C5FD',--}}
{{--                    '#A5B4FC',--}}
{{--                    '#FCD34D',--}}
{{--                    '#CBD5E1',--}}
{{--                ],--}}
{{--                hoverOffset: 4,--}}
{{--            }]--}}
{{--        };--}}

{{--        const lineData = {--}}
{{--            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],--}}
{{--            datasets: [{--}}
{{--                label: 'My First Dataset',--}}
{{--                data: [65, 59, 80, 81, 56, 55, 40],--}}
{{--                fill: false,--}}
{{--                borderColor: 'rgb(75, 192, 192)',--}}
{{--                tension: 0.1--}}
{{--            }]--}}
{{--        };--}}

{{--        new Chart(ctx, {--}}
{{--            type: 'pie',--}}
{{--            data: pieData,--}}
{{--            options: {--}}
{{--                maintainAspectRatio: false,--}}
{{--            }--}}
{{--        });--}}

{{--        new Chart(ctx2, {--}}
{{--            type: 'line',--}}
{{--            data: lineData,--}}
{{--            options: {--}}
{{--                maintainAspectRatio: false,--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

</div>
