@extends('layouts.admin-app')
@section('content')
    <div class="py-12 pt-20 space-y-10 bg-gray-100 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="lg:flex justify-between pt-6 px-5 pb-3 space-y-10">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            User Management
                        </h2>
                        <p class="text-gray-500">
                            View, edit, and manage all users in the system
                        </p>
                    </div>
                    <div class="space-x-3 flex">

                        <x-ui.modal.trigger id="add-new-user" class="my-4">
                            <button
                                class="btn btn-ghost text-white border-emerald-600 bg-emerald-600 rounded-xl font-light hover:opacity-80 ">
                                <x-ui.icon name="user-plus" class="size-4 font-bold"></x-ui.icon>
                                Add New User
                            </button>
                        </x-ui.modal.trigger>

                        <x-ui.modal
                            id="add-new-user"
                            position="center"
                            heading="Add User Form"
                        >
                            @livewire('admin.users.user-form')
                        </x-ui.modal>
                    </div>
                </div>

                <div class="px-5 py-4 space-y-2">
                    @livewire('admin.users.user-management')

                    <x-ui.modal
                        id="edit-user"
                        position="center"
                        heading="Edit User Form"
                    >
                        @livewire('admin.users.user-update')
                    </x-ui.modal>

                    <x-ui.modal
                        id="delete-user"
                        position="center"
                        heading="Delete User Form"
                    >
                        @livewire('admin.users.user-delete')
                    </x-ui.modal>

                </div>
            </div>
        </div>
    </div>
@endsection

