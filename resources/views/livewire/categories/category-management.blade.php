<div>
    <section class="w-full border border-gray-300 rounded-lg p-6 space-y-5 ">
        <p class="text-[15px] text-gray-900">Budget Summary</p>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5">

            <div class="flex flex-col items-center w-full rounded-lg space-y-2 p-4 bg-blue-50">
                <span class="flex space-x-2">
                    <x-ui.icon name="ps:wallet" variant="bold" class="size-5 text-blue-600"/>
                    <p class="text-[13px] font-semibold text-gray-500"> Total Budget</p>
                </span>
                <h1 class="text-xl font-semibold text-blue-600">₱{{number_format($totalBudget, 2)}}</h1>
            </div>
            <div class="flex flex-col items-center w-full rounded-lg space-y-2 p-4 bg-red-50">
                <span class="flex space-x-2">
                     <x-ui.icon name="ps:trend-down" variant="bold" class="size-5 text-red-600"/>
                    <p class="text-[13px] font-semibold text-gray-500"> Total Spent</p>
                </span>
                <h1 class="text-xl font-bold text-red-600">₱{{number_format($totalSpent, 2)}}</h1>
            </div>

            <div class="flex flex-col items-center w-full rounded-lg space-y-2 p-4 bg-green-50">
                <span class="flex space-x-2">
                     <x-ui.icon name="ps:trend-up" variant="bold" class="size-5 text-green-600"/>
                    <p class="text-[13px] font-semibold text-gray-500">Remaining</p>
                </span>
                <h1 class="text-xl font-bold text-green-600">₱{{number_format($totalRemaining, 2)}}</h1>
            </div>

        </div>
    </section>
    <section class="mt-5">
        @foreach($categories->groupBy('category_type') as $type => $group)

            <div class="border border-gray-300 rounded-lg p-6 space-y-5 mb-5">
                @php
                    $colors = [
                           'Essential' => 'bg-red-50 text-red-600',
                           'Lifestyle' => 'bg-blue-50 text-blue-600',
                           'Work & Business' => 'bg-green-50 text-green-600',
                            'Savings & Investments' => 'bg-yellow-50 text-yellow-600',
                            'Pet Expenses' => 'bg-rose-50 text-rose-600',
                            ];
                @endphp
                <span class="flex space-x-2 items-center">
                 <x-ui.badge size="sm" class="{{ $colors[$type] }}"><p class="{{ $colors[$type] }}">{{$type}}</p></x-ui.badge>
                    <p class="text-sm text-gray-500">({{$group->count()}} categories)</p>
                </span>

                @foreach($group as $category)
                 <div class="w-full border border-gray-300 p-4 rounded-lg hover:shadow-md transition-all duration-200" wire:key="{{$category->id}}">
                    <span class="flex justify-between items-center pb-5">
                         <p class="text-[15px] text-gray-900">{{$category->category_name}}</p>
                          <x-ui.modal.trigger id="update-category-modal" class="my-4">
                            <x-secondary-button class="space-x-2 p-1 px-2" wire:click="edit({{$category->id}})">
                             <x-ui.icon name="ps:note-pencil" class="size-5 text-gray-900"/>
                                <p class="text-[12px]">Edit</p>
                            </x-secondary-button>
                          </x-ui.modal.trigger>
                    </span>

                        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5">
                            <div class="flex flex-col items-center w-full rounded-lg  p-4 bg-blue-50">
                        <span class="flex space-x-2">
                            <p class="text-[13px] text-gray-500">Budget</p>
                        </span>
                                <h1 class="text-base font-semibold text-blue-600">₱{{number_format($category->monthly_budget, 2)}}</h1>
                            </div>

                            <div class="flex flex-col items-center w-full rounded-lg p-4 bg-red-50">
                        <span class="flex space-x-2">
                            <p class="text-[13px]  text-gray-500">Spent</p>
                        </span>
                                <h1 class="text-base font-bold text-red-600">₱{{number_format($category->spent, 2)}}</h1>
                            </div>

                            <div class="flex flex-col items-center w-full rounded-lg p-4 bg-green-50">
                        <span class="flex space-x-2">
                            <p class="text-[13px]  text-gray-500">Remaining</p>
                        </span>
                                <h1 class="text-base font-bold text-green-600">₱{{number_format($category->remaining, 2)}}</h1>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
</div>
