@extends('layouts.app')
@section('content')
    <div class="py-12 pt-20 space-y-10 bg-white ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:flex items-center justify-between">
                <div class="px-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Expenses Management
                    </h2>
                    <p class="text-gray-500">
                        Add, edit, and track your expenses
                    </p>
                </div>
                <div class="p-6 ">
                    <x-ui.modal.trigger id="add-expense" class="my-4">
                        <x-ui.button icon="plus">
                            Add Expenses
                        </x-ui.button>
                    </x-ui.modal.trigger>

                    <x-ui.modal
                        id="add-expense"
                        position="center"
                        heading="Add Expenses">
                        @livewire('expenses.expense-form')
                    </x-ui.modal>
                </div>
            </div>
                @livewire('budget-alert')
            <div class="px-6">
                @livewire('expenses.expense-table')
                <x-ui.modal id="edit-expense-modal" position="center" heading="Edit Expense">
                    @livewire('expenses.expense-edit')
                </x-ui.modal>

                <x-ui.modal id="delete-expense-modal" position="center" heading="Delete Expense">
                    @livewire('expenses.expense-delete')
                </x-ui.modal>
            </div>
        </div>
    </div>
@endsection
