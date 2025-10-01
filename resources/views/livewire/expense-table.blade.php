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

            <x-ui.select
                placeholder="All Categories"
                wire:model="#"
                class="w-full">
                {{--Need Loop Option--}}
                <x-ui.select.option value="All Categories">Personal</x-ui.select.option>
                <x-ui.select.option value="Business">Business</x-ui.select.option>
                <x-ui.select.option value="Shared">Shared</x-ui.select.option>
            </x-ui.select>

            <x-ui.select
                placeholder="All Wallets"
                wire:model="#"
                class="w-full">
                {{--Need Loop Option--}}
                <x-ui.select.option value="All Wallets">All Wallets</x-ui.select.option>
                <x-ui.select.option value="business">Business</x-ui.select.option>
                <x-ui.select.option value="shared">Shared</x-ui.select.option>
            </x-ui.select>

        </div>
    </div>

    <div class="rounded-box border border-base-content/5 bg-base-100 overflow-x-auto">
        <table class="table overflow-x-auto w-full">
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
                     <span
                         wire:click="sortBy('amount')"
                         class="inline-flex items-center gap-1 cursor-pointer hover:underline">
                       <p>Amount</p>
                       @if($sort === 'amount')
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

            </tr>
            </thead>
            <tbody>
            @forelse($expenses as $index)
                <tr class="text-center" wire:key="{{ $index->id }}">
                    <td>{{$index->date->format('Y-m-d')}}</td>
                    <td class="font-semibold text-[#118139]">₱{{number_format($index->amount, 2)}}</td>
                    <td>{{ucwords($index->category)}}</td>
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
                        @endswitch
                    </td>
                    <td class="text-start">@if($index->notes == null)
                            <p class="text-gray-600 font-light">No Additional Notes</p>
                        @else
                            {{$index->notes}}
                        @endif
                    </td>
                    @empty
                    <td colspan="6">
                           <p class="text-center text-2xl text-gray-500"> No Data Found</p>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
