<div>
{{--    <flux:modal.trigger name="edit-profile">--}}
{{--        <flux:button>--}}
{{--        <flux:icon.plus class="w-5"></flux:icon.plus>--}}
{{--            Add Wallet--}}
{{--        </flux:button>--}}
{{--    </flux:modal.trigger>--}}

{{--    <flux:modal name="edit-profile" class="md:w-96">--}}
{{--        <div class="space-y-6">--}}
{{--            <div>--}}
{{--                <flux:heading size="lg">Add Wallet</flux:heading>--}}
{{--            </div>--}}

{{--            <form wire:submit="save()" method="POST">--}}
{{--                <flux:input wire:model="wallet_name" class="@error('wallet_name') is-invalid @enderror"--}}
{{--                            label="Wallet Name" placeholder="Enter Wallet Name"/>--}}
{{--                <flux:input wire:model="current_balance" type="number" class="@error('current_balance') is-invalid @enderror"--}}
{{--                            label="Current Balance" placeholder="Enter Current Balance"/>--}}

{{--                <flux:select wire:model="wallet_type" label="Wallet Type" class="">--}}
{{--                    <flux:select.option disabled selected>Select Wallet</flux:select.option>--}}
{{--                    <flux:select.option value="personal">personal</flux:select.option>--}}
{{--                    <flux:select.option value="business">Business</flux:select.option>--}}
{{--                    <flux:select.option value="shared">Shared</flux:select.option>--}}
{{--                </flux:select>--}}

{{--                <div class="flex pt-5">--}}
{{--                    <flux:spacer/>--}}
{{--                    <flux:button type="submit" variant="primary">Submit</flux:button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            --}}
{{--        </div>--}}
{{--    </flux:modal>--}}

    <x-ui.modal.trigger id="center-position" class="my-4">
        <x-ui.button>
            Center Modal Trigger
        </x-ui.button>
    </x-ui.modal.trigger>


    <x-ui.modal
        id="center-position"
        position="center"
        heading="Center Modal"
        description="This modal is centered vertically"
    >
        <p>Modal content goes here...</p>
    </x-ui.modal>


    <x-ui.modal.trigger id="basic-modal">
        <x-ui.button>
            Open
        </x-ui.button>
    </x-ui.modal.trigger>

    <x-ui.modal
        id="basic-modal"
        heading="Basic Modal"
        description="This is a simple modal example"
    >
        <p>Modal content goes here...</p>
    </x-ui.modal>

</div>
