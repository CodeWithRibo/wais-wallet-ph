@php use Carbon\Carbon; @endphp
<div>
    {{--Users Card Overall--}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 ">
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Users</h1>
                    <x-ui.icon name="users" class="text-emerald-600 size-5"/>
                </div>
                    <p class="text-xl">{{$totalUsers ?? 0}}</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Active Users</h1>
                    <div class="w-[6px] h-[6px] rounded-full bg-emerald-600"></div>
                </div>
                    <p class="text-xl">{{$activeUsers ?? 0}}</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Inactive Users</h1>
                    <div class="w-[6px] h-[6px] rounded-full bg-gray-400"></div>
                </div>
                    <p class="text-xl">{{$inactiveUsers ?? 0}}</p>
            </span>
        </div>
        <div class="border rounded-xl bg-white py-3 px-4 w-full ">
            <span class="">
                <div class="flex items-center justify-between mb-2 space-y-2">
                    <h1 class="text-gray-500 text-sm mt-2 ">Total Wallets</h1>
                    <x-ui.icon name="wallet" class="text-emerald-600 size-5"/>
                </div>
                    <p class="text-xl">{{$totalWallets ?? 0}}</p>
            </span>
        </div>
    </div>
    {{--Search Users--}}
    <div class="mt-8 bg-white p-6 rounded-xl flex gap-3">
        <div class="relative w-full">
            <x-ui.icon name="ps:magnifying-glass" class="size-5  absolute bottom-[0.6rem] left-3 text-gray-500"/>
            <input type="search"
                   placeholder="Search by name or email..."
                   class="w-full pl-10 bg-gray-100 rounded-xl py-2 border-none
                   focus:outline-hidden focus:ring-2 focus:ring-emerald-500
                   focus:ring-offset-2 transition-all duration-300"/>
        </div>
        <x-ui.icon name="ps:funnel" class="size-10 fill-gray-500"/>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">All</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Active</x-ui.button>
        <x-ui.button class="bg-gray-100 text-gray-500 rounded-lg border-none">Inactive</x-ui.button>
    </div>

    {{--Users Table--}}
    <div class="overflow-y-visible overflow-x-auto relative rounded-lg border-2 border-gray-200  mt-6 ">
        <table class="table">
            <thead>
            <tr class="text-center bg-gray-100 text-gray-600">
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Wallets</th>
                <th>Status</th>
                <th>Last Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="z-0 bg-base-100">
            <!-- row 1 -->
          @foreach($this->users as $user)
              <tr class="text-center hover:bg-gray-100 transition-all duration-200" wire:key="{{$user->id}}">
                  <td class="p-5">
                      <div class="flex items-center gap-3">
                          <div class="w-10 h-10 bg-[#B9F3D0] rounded-full flex items-center justify-center">
                          <span class="text-emerald-600">{{substr(strtoupper($user->name), 0, 1)}}</span>
                          </div>
                          <span> {{$user->name}}</span>
                      </div>
                  </td>
                  <td class="text-gray-500">{{$user->email}}</td>
                  <td>
                      @switch($user->role)
                          @case('user')
                              <x-ui.badge pill color="personal" class="text-xs">User</x-ui.badge>
                              @break
                          @case('admin')
                              <x-ui.badge pill color="shared" size="sm" class="text-xs">Admin</x-ui.badge>
                              @break
                      @endswitch
                  </td>
                      <td class="text-center">{{$user->wallet_count ?? 0}}</td>
                  <td>
                      @switch($user->is_active)
                          @case(true)
                              <x-ui.badge pill color="create" class="text-xs">active</x-ui.badge>
                              @break
                          @case(false)
                              <x-ui.badge pill color="archive" size="sm" class="text-xs">inactive</x-ui.badge>
                              @break
                      @endswitch
                  </td>

                  <td class="text-gray-500">{{Carbon::parse($user->last_login_at)->diffForHumans()}}</td>
                  <td class=" pl-10 relative right-0">
                      <x-ui.dropdown :portal="true" class="cursor-pointer"  position="bottom-center">
                          <x-slot:button class="p-0">
                              <x-ui.icon name="ps:dots-three-vertical" class="size-5 font-bold"/>
                          </x-slot:button>

                          <x-slot:menu>
                              <x-ui.dropdown.item icon="ps:pencil" icon-variant="bold" variant="soft">
                                  <x-ui.modal.trigger id="edit-user" class="my-4">
                                          Edit User
                                  </x-ui.modal.trigger>
                              </x-ui.dropdown.item>

                              <x-ui.dropdown.item icon="ps:prohibit" icon-variant="bold" variant="soft">
                                  Deactivate
                              </x-ui.dropdown.item>

                              <x-ui.dropdown.item icon="ps:trash" icon-variant="bold" variant="danger">
                                  <x-ui.modal.trigger id="delete-user" class="my-4">
                                      Delete User
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
    {{$this->users->links()}}
</div>
