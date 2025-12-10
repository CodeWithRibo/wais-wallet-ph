<div>
    {{--Wallet Card Overall--}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 ">
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Balance</h1>
                    <x-ui.icon name="ps:money-wavy" class="text-emerald-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">₱179,891.5</p>
                    <p class="text-xs text-gray-500">Across all wallets</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Personal</h1>
                    <x-ui.icon name="ps:user"  class="text-blue-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">2</p>
                    <p class="text-xs text-gray-500">₱38,450</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Business</h1>
                    <x-ui.icon name="ps:briefcase"  class="text-emerald-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">2</p>
                    <p class="text-xs text-gray-500">₱124,501.25</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Shared</h1>
                    <x-ui.icon name="ps:users-three" class="text-purple-600 size-5"/>
                </div>
                    <p class="text-xl mb-2">3</p>
                    <p class="text-xs text-gray-500">₱124,501.25</p>
            </span>
        </div>
    </div>

    {{--Search Wallet--}}
    <div class="mt-8 bg-white p-6 rounded-xl flex gap-3">
        <div class="relative w-full">
            <x-ui.icon name="ps:magnifying-glass" class="size-5  absolute bottom-[0.6rem] left-3 text-gray-500"/>
            <input type="search"
                   placeholder="Search by wallet name or owner..."
                   class="w-full pl-10 bg-gray-100 rounded-xl py-2 border-none
                   focus:outline-hidden focus:ring-2 focus:ring-emerald-500
                   focus:ring-offset-2 transition-all duration-300"/>
        </div>
        <x-ui.icon name="ps:funnel" class="size-10 fill-gray-500"/>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">All</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Personal</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Business</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Shared</x-ui.button>
    </div>

    {{--Wallet Table--}}
    <div class="overflow-y-visible overflow-x-auto relative rounded-lg border-2 border-gray-200  mt-6 ">
        <table class="table">
            <thead>
            <tr class="text-center bg-gray-100 text-gray-600">
                <th>Wallet Name</th>
                <th>Owner</th>
                <th>Type</th>
                <th>Balance</th>
                <th>Members</th>
                <th>Last Transaction</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="z-0 bg-base-100">
            @php
                $users = [1,2]; //temporary value
            @endphp
                <!-- row 1 -->
            @foreach($users as $user)
                <tr class="text-center hover:bg-gray-100 transition-all duration-200" wire:key="user-row-{{ \Str::slug($user) }}">
                    <td class="p-5 flex items-center justify-center gap-4">
                            <x-ui.icon name="ps:wallet" class="size-5  text-emerald-600 "/>
                            <p>Personal Expenses</p>
                        </td>
                    <td class="text-gray-500">John Doe</td>
                    <td>
                        @php
                            $type = 'shared'; //Temporary value
                        @endphp
                        @switch($type)
                            @case('personal')
                                <x-ui.badge pill color="personal" class="text-xs">Personal</x-ui.badge>
                                @break
                            @case('business')
                                <x-ui.badge pill color="business" size="sm" class="text-xs">Business</x-ui.badge>
                                @break
                            @case('shared')
                                <x-ui.badge pill color="shared" size="sm" class="text-xs">Shared</x-ui.badge>
                                @break
                        @endswitch
                    </td>
                    <td class="text-center">₱5,420.5</td>
                    <td class="text-gray-500">
                        4 members
                    </td>
                    <td class="text-gray-500">2 minutes ago</td>
                    <td class=" pl-10 relative right-0">
                        <x-ui.dropdown :portal="true" class="cursor-pointer"  position="bottom-center">
                            <x-slot:button class="p-0">
                                <x-ui.icon name="ps:dots-three-vertical" class="size-5 font-bold"/>
                            </x-slot:button>

                            <x-slot:menu>
                                <x-ui.dropdown.item icon="ps:trend-up" icon-variant="bold" variant="soft">
                                    <x-ui.modal.trigger id="view-details" class="my-4">
                                        View Details
                                    </x-ui.modal.trigger>

                                </x-ui.dropdown.item>

                                <x-ui.dropdown.item icon="ps:note-pencil" icon-variant="bold" variant="soft">
                                    <x-ui.modal.trigger id="edit-wallet" class="my-4">
                                        Edit Wallet
                                    </x-ui.modal.trigger>
                                </x-ui.dropdown.item>

                                <x-ui.dropdown.item icon="ps:trash" icon-variant="bold" variant="danger">
                                    <x-ui.modal.trigger id="delete-wallet" class="my-4">
                                        Delete Wallet
                                    </x-ui.modal.trigger>
                                </x-ui.dropdown.item>

                            </x-slot:menu>
                        </x-ui.dropdown>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
