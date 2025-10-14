@extends('layouts.app')
@section('content')
     <div class="py-12 pt-20 space-y-10 bg-white ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:flex items-center justify-between">
                <div class="px-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Wallet Management
                    </h2>
                    <p class="text-gray-500">
                        Manage your different wallets and accounts
                    </p>
                </div>
                <div class="p-6 ">
                    <x-ui.modal.trigger id="add-wallet" class="my-4">
                        <x-ui.button icon="plus">
                            Add Wallet
                        </x-ui.button>
                    </x-ui.modal.trigger>

                    <x-ui.modal
                        id="add-wallet"
                        position="center"
                        heading="Add Wallet">
                        @livewire('wallet-form')
                    </x-ui.modal>
                </div>
            </div>
        </div>
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="px-6">
                 @livewire('wallet-management')

                 <x-ui.modal
                     id="edit-wallet-modal"
                     position="center"
                     heading="Edit Wallet">
                     @livewire('wallet-edit')
                 </x-ui.modal>
             </div>

         </div>
     </div>

@endsection
