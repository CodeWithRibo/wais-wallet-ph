@extends('layouts.app')
@section('content')
    <div class="py-12 pt-20 space-y-10 bg-white ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:flex items-center justify-between">
                <div class="px-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Category Management
                    </h2>
                    <p class="text-gray-500">
                        Manage your expense categories and budgets
                    </p>
                </div>
                <div class="p-6 ">
                    <x-ui.modal.trigger id="add-category" class="my-4">
                        <x-ui.button icon="plus">
                            Add Category
                        </x-ui.button>
                    </x-ui.modal.trigger>

                    <x-ui.modal
                        id="add-category"
                        position="center"
                        heading="Add Category">
                        @livewire('categories.category-form')
                    </x-ui.modal>
                </div>
            </div>
            @livewire('budget-alert')
            <div class="p-6 ">
                @livewire('categories.category-management')

                <x-ui.modal
                    id="update-category-modal"
                    position="center"
                    heading="Update Category">
                    @livewire('categories.category-update')
                </x-ui.modal>

                <x-ui.modal
                    id="delete-category-modal"
                    position="center"
                    heading="Delete Category">
                    @livewire('categories.category-delete')
                </x-ui.modal>
            </div>
        </div>
    </div>
@endsection
