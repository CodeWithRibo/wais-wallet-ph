<div>
    {{-- Category Card Overall --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 ">
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Categories</h1>
                    <x-ui.icon name="ps:folder-open" class="text-emerald-600 size-5" />
                </div>
                <p class="text-xl">6</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Default Categories</h1>
                    <x-ui.icon name="ps:tag" class="text-emerald-600 size-5" />
                </div>
                <p class="text-xl">6</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Custom Categories</h1>
                    <x-ui.icon name="ps:tag" class="text-blue-600 size-5" />
                </div>
                <p class="text-xl">6</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Usage</h1>
                    <x-ui.icon name="ps:folder-open" class="text-emerald-600 size-5" />
                </div>
                <p class="text-xl">28</p>
            </span>
        </div>
    </div>
    {{-- Search Categories --}}
    <div class="mt-8 bg-white p-6 rounded-xl flex gap-3">
        <div class="relative w-full">
            <x-ui.icon name="ps:magnifying-glass" class="size-5  absolute bottom-[0.6rem] left-3 text-gray-500" />
            <input type="search" placeholder="Search by categories..."
                class="w-full pl-10 bg-gray-100 rounded-xl py-2 border-none
                                               focus:outline-hidden focus:ring-2 focus:ring-emerald-500
                                               focus:ring-offset-2 transition-all duration-300" />
        </div>
        <x-ui.icon name="ps:funnel" class="size-10 fill-gray-500"/>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">All</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Default</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Custom</x-ui.button>
    </div>

    @php
        $test = [1, 2, 3];
    @endphp
    <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="p-5 bg-white rounded-lg shadow">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-gray-900">Groceries</h1>
                    <span class="text-gray-500 text-sm">245 uses</span>
                </div>
                <span class="flex items-center gap-5">
                    <x-ui.modal.trigger id="edit-category">
                        <x-ui.icon name="ps:note-pencil" class="size-4" />
                    </x-ui.modal.trigger>
                    <x-ui.modal.trigger id="delete-category">
                    <x-ui.icon name="ps:trash" variant="bold" class=" size-4 fill-red-600" />
                    </x-ui.modal.trigger>
                </span>
            </div>
            <div class="w-full border-[0.1px] border-gray-100 my-3"></div>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-base">Default Category</span>
                <x-ui.badge color="create">Essential</x-ui.badge>
            </div>
        </div>
        <div class="p-5 bg-white rounded-lg shadow">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-gray-900">Groceries</h1>
                    <span class="text-gray-500 text-sm">245 uses</span>
                </div>
                <span class="flex items-center gap-5">
                    <x-ui.icon name="ps:note-pencil" class="size-4" />
                    <x-ui.icon name="ps:trash" variant="bold" class=" size-4 fill-red-600" />
                </span>
            </div>
            <div class="w-full border-[0.1px] border-gray-100 my-3"></div>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-base">Default Category</span>
                <x-ui.badge color="create">Essential</x-ui.badge>
            </div>
        </div>
        <div class="p-5 bg-white rounded-lg shadow">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-gray-900">Groceries</h1>
                    <span class="text-gray-500 text-sm">245 uses</span>
                </div>
                <span class="flex items-center gap-5">
                    <x-ui.icon name="ps:note-pencil" class="size-4" />
                    <x-ui.icon name="ps:trash" variant="bold" class=" size-4 fill-red-600" />
                </span>
            </div>
            <div class="w-full border-[0.1px] border-gray-100 my-3"></div>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-base">Default Category</span>
                <x-ui.badge color="create">Essential</x-ui.badge>
            </div>
        </div>
    </div>

</div>
