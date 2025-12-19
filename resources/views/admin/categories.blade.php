@extends('layouts.admin-app')
@section('content')
    <div class="py-12 pt-20 space-y-10 bg-gray-100 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="lg:flex justify-between pt-6 px-5 pb-3 space-y-10">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Category Management
                        </h2>
                        <p class="text-gray-500">
                            Create and manage default categories for all users
                        </p>
                    </div>
                    <div class="space-x-3 flex">

                        <x-ui.modal.trigger id="add-category" class="my-4">
                            <button
                                class="btn btn-ghost text-white border-emerald-600 bg-emerald-600 rounded-xl font-light hover:opacity-80 ">
                                <x-ui.icon name="ps:plus" class="size-4 font-bold"></x-ui.icon>
                                Add Category
                            </button>
                        </x-ui.modal.trigger>

                        <x-ui.modal
                            id="add-category"
                            position="center"
                            heading="Add Category Form"
                        >
                        @livewire('admin.categories.category-form')
                        </x-ui.modal>
                    </div>
                </div>

                <div class="px-5 py-4 space-y-2">
                    @livewire('admin.categories.category-management')

                    <x-ui.modal
                        id="edit-category"
                        position="center"
                        heading="Edit Category"
                    >
                        @livewire('admin.categories.category-update')
                    </x-ui.modal>

                    <x-ui.modal
                        id="delete-category"
                        position="center"
                        heading="Delete Category"
                    >
                        @livewire('admin.categories.category-delete')
                    </x-ui.modal>
                </div>
            </div>
        </div>
    </div>

@endsection
