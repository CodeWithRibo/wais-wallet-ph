<div>
    <div class=" rounded-box border border-base-content/5 bg-base-100 mb-5 p-8">
          <span class="flex items-center gap-2 mb-3">
                <x-ui.icon class="size-5" name="funnel"></x-ui.icon>
                <p>Filters & Search</p>
          </span>
        <div class="md:flex items-center space-y-3 md:space-y-0 gap-3">
            <x-ui.input
                wire:model.live.debounce.300ms="search"
                placeholder="Search expense.."
                class="w-full"
                leftIcon="magnifying-glass"
            />

            @php
                $category = \App\Models\Category::pluck('category_name')->mapWithKeys(fn ($v) => [$v => $v]);
                $wallets = \App\Models\Wallet::pluck('wallet_name')->mapWithKeys(fn ($v) => [$v => $v]);
            @endphp
            <x-select-option wire:model="category_filter"
                             wire:change="sortBy('category')"
                             :options="array_merge(['All Categories' => 'All Categories'], $category->toArray())">
            </x-select-option>


            <x-select-option wire:model="wallet_filter"
                             wire:change="sortBy('wallet_type')"
                             :options="array_merge(['All Wallet' => 'All Wallet'], $wallets->toArray())">
            </x-select-option>

        </div>
    </div>

    <div class="rounded-box border border-base-content/5 bg-base-100 overflow-x-auto">
        <table class="table overflow-x-auto w-full">
            <p class="p-6 text-gray-500 ">Expenses ({{$expenseCount}})</p>
            <thead>
            <tr class="text-center">
                <th>
                   <span
                       wire:click="sortBy('date')"
                       class="inline-flex items-center gap-1 cursor-pointer hover:underline">
                       <p>Date</p>
                       @if($sort === 'date')
                           @if($sortDirection === 'ASC')
                               <x-ui.icon name="arrow-up" class="size-3 text-gray-500"></x-ui.icon>
                           @else
                               <x-ui.icon name="arrow-down" class="size-3 text-gray-500"></x-ui.icon>
                           @endif
                       @endif
                   </span>
                </th>
                <th>
                    Amount
                </th>
                <th>
                      <span
                          wire:click="sortBy('category')"
                          class="inline-flex items-center gap-1 cursor-pointer hover:underline">
                       <p>Category</p>
                       @if($sort === 'category')
                              @if($sortDirection === 'ASC')
                                  <x-ui.icon name="arrow-up" class="size-3 text-gray-500"></x-ui.icon>
                              @else
                                  <x-ui.icon name="arrow-down" class="size-3 text-gray-500"></x-ui.icon>
                              @endif
                          @endif
                   </span>
                </th>
                <th>
                     <span
                         wire:click="sortBy('wallet_type')"
                         class="inline-flex items-center gap-1 cursor-pointer hover:underline">
                       <p>Wallet</p>
                       @if($sort === 'wallet_type')
                             @if($sortDirection === 'ASC')
                                 <x-ui.icon name="arrow-up" class="size-3 text-gray-500"></x-ui.icon>
                             @else
                                 <x-ui.icon name="arrow-down" class="size-3 text-gray-500"></x-ui.icon>
                             @endif
                         @endif
                   </span>
                </th>
                <th>
                    <span
                        wire:click="sortBy('payment_method')"
                        class="inline-flex items-center gap-1 cursor-pointer hover:underline">
                       <p>Payment Method</p>
                       @if($sort === 'payment_method')
                            @if($sortDirection === 'ASC')
                                <x-ui.icon name="arrow-up" class="size-3 text-gray-500"></x-ui.icon>
                            @else
                                <x-ui.icon name="arrow-down" class="size-3 text-gray-500"></x-ui.icon>
                            @endif
                        @endif
                   </span>
                </th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php
                $colors = [
                           'Essential' => 'bg-red-50 text-red-600',
                           'Lifestyle' => 'bg-blue-50 text-blue-600',
                           'Work & Business' => 'bg-green-50 text-green-600',
                            'Savings & Investments' => 'bg-yellow-50 text-yellow-600',
                            'Pet Expenses' => 'bg-rose-50 text-rose-600',
                            ];
//                   <x-ui.badge size="sm" class="{{ $colors[$type] }}"><p class="{{ $colors[$type] }}">{{$type}}</p></x-ui.badge>
            @endphp
            @if($expenses->isNotEmpty())
                @foreach($expenses as $index)
                    <tr class="text-center" wire:key="{{ $index->id }}">
                        <td>{{$index->date->format('Y-m-d')}}</td>
                        <td class="font-semibold text-[#118139]">₱{{number_format($index->amount, 2)}}</td>
                        <td>{{$index->category}}</td>
                        <td>
                            <x-ui.badge size="sm" variant="outline">{{ucwords($index->wallet_type)}}</x-ui.badge>
                        </td>
                        <td class="text-center">
                            @switch($index->payment_method)
                                @case('Cash')
                                    <x-ui.badge color="Cash">{{$index->payment_method}}</x-ui.badge>
                                    @break
                                @case('Gcash')
                                    <x-ui.badge color="Gcash">{{$index->payment_method}}</x-ui.badge>
                                    @break
                                @case('Maya')
                                    <x-ui.badge color="Maya">{{$index->payment_method}}</x-ui.badge>
                                    @break
                                @case('Card')
                                    <x-ui.badge>{{$index->payment_method}}</x-ui.badge>
                                    @break
                                @default
                                    <p class="text-gray-600">N/A</p>
                                    @break
                            @endswitch
                        </td>
                        <td class="text-start">
                            @if($index->notes == null)
                                <p class="text-gray-600 font-light">No Additional Notes</p>
                            @else
                                <p class="text-gray-800">{{$index->notes}}</p>
                            @endif
                        </td>
                        <td>
                            <div class="flex space-x-3">
                                <div>
                                    <x-ui.modal.trigger id="edit-expense-modal" class="my-4">
                                        <x-ui.button variant="outline"
                                                     color="blue"
                                                     icon="pencil-square"

                                                     wire:click="edit({{$index->id}})">Edit
                                        </x-ui.button>
                                    </x-ui.modal.trigger>
                                </div>
                                <div>
                                    <x-ui.modal.trigger id="delete-expense-modal" class="my-4">
                                        <x-ui.button
                                            variant="outline"
                                            color="red"
                                            icon="trash"
                                            wire:click="delete({{$index->id}})"
                                        >Delete
                                        </x-ui.button>
                                    </x-ui.modal.trigger>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center py-10">
                        @if(!empty($search))
                            <p class="text-gray-500 text-xl font-medium">
                                No results found for "<span class="italic">{{ $search }}</span>"
                            </p>
                        @else
                            <p class="text-gray-500 text-xl font-medium">
                                No expenses recorded yet
                            </p>
                        @endif
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        {{$expenses->links()}}
    </div>
</div>
