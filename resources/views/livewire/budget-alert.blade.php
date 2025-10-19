<div>
    @if($isExceeded)
        <div class="p-6">
            <div class="p-6 w-full bg-orange-50 border border-orange-100 rounded-lg space-y-7">
                <div class="flex gap-2">
                    <x-ui.icon name="ps:warning" class="text-orange-400"/>
                    <p class="text-orange-400">Budget Alerts</p>
                    <p class="text-orange-400 bg-orange-200 px-2 rounded-full w-auto text-start ">{{$exceededCount ?? 0}}</p>
                </div>
                @foreach($budgetAlerts as $index)
                    <div
                        class="sm:flex space-y-5 sm:space-y-0 justify-between items-center bg-white p-4 rounded-lg w-full">
                          <span class="flex items-center gap-3">
                               <x-ui.icon name="ps:warning" class="text-orange-400"/>
                              <span>
                                  <p>{{$index->category_name}}</p>
                                  <p class="text-sm text-gray-500">Over budget by ₱{{abs($index->remaining)}}</p>
                              </span>
                          </span>
                        <span class="">
                               <p class="pl-8">₱{{$index->spent}} / ₱{{$index->monthly_budget}}</p>
                               <p class="pl-8 text-sm text-red-600">₱{{abs($index->remaining)}} over</p>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


</div>
