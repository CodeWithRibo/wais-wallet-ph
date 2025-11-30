@extends('layouts.admin-app')
@section('content')
    <div class="py-12 pt-20 space-y-10 bg-gray-100 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="lg:flex justify-between pt-6 px-5 pb-3 space-y-10">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Wallet Management
                        </h2>
                        <p class="text-gray-500">
                            View and manage all wallets across the system
                        </p>
                    </div>
                    <div class="space-x-3 flex">

                        <x-ui.modal.trigger id="add-wallet" class="my-4">
                            <button
                                class="btn btn-ghost text-white border-emerald-600 bg-emerald-600 rounded-xl font-light hover:opacity-80 ">
                                <x-ui.icon name="plus" class="size-4 font-bold"></x-ui.icon>
                                Add Wallet
                            </button>
                        </x-ui.modal.trigger>

                        <x-ui.modal
                            id="add-wallet"
                            position="center"
                            heading="Add Wallet Form"
                            description="Adding wallet"
                        >
                        </x-ui.modal>
                    </div>
                </div>

                <div class="px-5 py-4 space-y-2">
                    @livewire('admin.wallets.wallet-management')
                    {{--View Details Modal--}}
                    @livewire('admin.wallets.view-details')


                    <x-ui.modal
                        id="edit-wallet"
                        position="center"
                        heading="Edit Wallet"
                    >
                        <p>Edit Wallet Content...</p>
                    </x-ui.modal>

                    <x-ui.modal
                        id="delete-wallet"
                        position="center"
                        heading="Delete Wallet"
                    >
                        <p>Delete Wallet Content...</p>
                    </x-ui.modal>
                </div>
            </div>
        </div>
    </div>
@endsection

