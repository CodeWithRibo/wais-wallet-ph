<div>
    {{-- Audit Logs Card Overall --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 ">
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Logs</h1>
                    <x-ui.icon name="ps:file-text" variant="bold" class="text-emerald-600 size-5" />
                </div>
                <p class="text-xl">6</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Info</h1>
                    <x-ui.icon name="ps:check-circle" variant="bold" class="text-emerald-600 size-5" />
                </div>
                <p class="text-xl">6</p>
            </span>
        </div>
        <div class="border border-amber-200 rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Warning</h1>
                    <x-ui.icon name="ps:warning-circle" variant="bold" class="text-amber-600 size-5" />
                </div>
                <p class="text-xl">6</p>
            </span>
        </div>
        <div class="border border-red-200 rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Critical</h1>
                    <x-ui.icon name="ps:warning" variant="bold" class="text-red-600 size-5" />
                </div>
                <p class="text-xl">28</p>
            </span>
        </div>
    </div>
    {{-- Search Logs --}}
    <div class="mt-8 bg-white p-6 rounded-xl flex gap-3">
        <div class="relative w-full">
            <x-ui.icon name="ps:magnifying-glass" class="size-5  absolute bottom-[0.6rem] left-3 text-gray-500" />
            <input type="search" placeholder="Search logs by user, action, or resource..."
                   class="w-full pl-10 bg-gray-100 rounded-xl py-2 border-none
                                               focus:outline-hidden focus:ring-2 focus:ring-emerald-500
                                               focus:ring-offset-2 transition-all duration-300" />
        </div>
        <x-ui.icon name="ps:funnel" class="size-10 fill-gray-500"/>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">All</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Info</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Warning</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Critical</x-ui.button>
    </div>

    {{--Logs Table--}}
    <div class="overflow-y-visible overflow-x-auto relative rounded-lg border-2 border-gray-200  mt-6 ">
        <table class="table">
            <thead>
            <tr class="text-center bg-gray-100 text-gray-600">
                <th>Severity</th>
                <th>Timestamp</th>
                <th>User</th>
                <th>Action</th>
                <th>Resource</th>
                <th>Details</th>
                <th>IP Address</th>
            </tr>
            </thead>
            <tbody class="z-0 bg-base-100">
            @php
                $logs = [1,2,3,4,5,6,7,8,9,10]; //temporary value
            @endphp
            @foreach($logs as $log)
                <tr class="text-center hover:bg-gray-100 transition-all duration-200" wire:key="log-row-{{ \Str::slug($log) }}">
                    <td class="p-5 flex justify-center">
                        <x-ui.icon name="ps:warning-circle" variant="bold" class="fill-amber-600 size-4"/>
                    </td>
                       <td class="text-gray-500">2025-11-10 14:32:15</td>
                    <td>
                        Admin John Doe
                    </td>
                    <td class="text-center ">
                        <span class="bg-gray-100 rounded-full py-1 px-3 text-xs">User Deactivated</span>
                    </td>
                    <td>
                        user.inactive@example.com
                    </td>
                    <td class="text-gray-500">User account deactivated due to inactivity</td>
                    <td class="text-gray-500 text-center text-xs">
                        192.168.1.100
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
