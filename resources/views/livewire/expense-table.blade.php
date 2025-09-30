<div>
    <div class=" rounded-box border border-base-content/5 bg-base-100 mb-5 p-8">
          <span class="flex items-center gap-2 mb-3">
                <x-ui.icon  class="size-5" name="funnel"></x-ui.icon>
                <p>Filters & Search</p>
          </span>
        <div class="md:flex items-center space-y-3 md:space-y-0 gap-3">
            <x-ui.input
                x-model="search"
                placeholder="Search..."
                class="w-full"
                leftIcon="magnifying-glass"
            />
{{--TEMPLATE (FIXING SORTING) --}}
            <x-ui.select
                placeholder="Select Wallet"
                wire:model="wallet_type"
                class="w-full">
                <x-ui.select.option value="personal" icon="wallet">Personal</x-ui.select.option>
                <x-ui.select.option value="business" icon="credit-card">Business</x-ui.select.option>
                <x-ui.select.option value="shared" icon="share">Shared</x-ui.select.option>
            </x-ui.select>

            <x-ui.select
                placeholder="Select Wallet"
                wire:model="wallet_type"
                class="w-full">
                <x-ui.select.option value="personal" icon="wallet">Personal</x-ui.select.option>
                <x-ui.select.option value="business" icon="credit-card">Business</x-ui.select.option>
                <x-ui.select.option value="shared" icon="share">Shared</x-ui.select.option>
            </x-ui.select>

            <x-ui.select
                placeholder="Select Wallet"
                wire:model="wallet_type"
                class="w-full">
                <x-ui.select.option value="personal" icon="wallet">Personal</x-ui.select.option>
                <x-ui.select.option value="business" icon="credit-card">Business</x-ui.select.option>
                <x-ui.select.option value="shared" icon="share">Shared</x-ui.select.option>
            </x-ui.select>

            <x-ui.select
                placeholder="Select Wallet"
                wire:model="wallet_type"
                class="w-full">
                <x-ui.select.option value="personal" icon="wallet">Personal</x-ui.select.option>
                <x-ui.select.option value="business" icon="credit-card">Business</x-ui.select.option>
                <x-ui.select.option value="shared" icon="share">Shared</x-ui.select.option>
            </x-ui.select>
        </div>
    </div>

   <div class="rounded-box border border-base-content/5 bg-base-100 overflow-x-auto">
       <table class="table overflow-x-auto w-full">
           <thead>
           <tr class="text-center">
               <th>Date</th>
               <th>Amount</th>
               <th>Category</th>
               <th>Wallet</th>
               <th>Payment Method</th>
               <th>Notes</th>
           </tr>
           </thead>
           <tbody>
           @foreach($expenses as $index)
               <tr class="text-center">
                   <td>{{$index->date->format('Y-m-d')}}</td>
                   <td class="font-semibold text-[#118139]">₱{{number_format($index->amount, 2)}}</td>
                   <td>{{ucwords($index->category)}}</td>
                   <td>
                       <x-ui.badge size="sm" variant="outline">{{ucwords($index->wallet_type)}}</x-ui.badge>
                   </td>
                   <td class="text-center">
                       @switch($index->payment_method)
                           @case('cash')
                               <x-ui.badge color="cash">{{ucfirst($index->payment_method)}}</x-ui.badge>
                               @break
                           @case('gcash')
                               <x-ui.badge color="gcash">{{ucfirst($index->payment_method)}}</x-ui.badge>
                               @break
                           @case('maya')
                               <x-ui.badge color="maya">{{ucfirst($index->payment_method)}}</x-ui.badge>
                               @break
                           @case('card')
                               <x-ui.badge>{{ucfirst($index->payment_method)}}</x-ui.badge>
                               @break
                       @endswitch
                   </td>
                   <td class="text-start">@if($index->notes == null)
                           <p class="text-gray-600 font-light">No Additional Notes</p>
                       @else
                           {{$index->notes}}
                       @endif
                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
   </div>
</div>
