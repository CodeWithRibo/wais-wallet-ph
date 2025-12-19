<div>
    <form wire:submit="save" method="POST">
        <x-ui.fieldset label="Wallet Information">
            <x-ui.field required>
                <x-ui.label>Wallet</x-ui.label>
                <x-ui.input placeholder="Enter Wallet Name"
                            wire:model="wallet_name"/>
                <x-ui.error name="wallet_name"/>

            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Current Balance</x-ui.label>
                <x-ui.input type="number"
                            step="0.01"
                            placeholder="Enter Current Balance"
                            wire:model="current_balance"/>
                <x-ui.error name="current_balance"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Wallet Type</x-ui.label>
                <x-select-option wire:model="wallet_type"
                                 :options="['' => 'Select Wallet type','Personal' => 'Personal','Business' => 'Business', 'Shared' => 'Shared']">
                </x-select-option>
            </x-ui.field>
            <x-ui.error name="wallet_type"/>
            <div class=" mt-5 flex items-center justify-center">
                <x-ui.button type="submit">Submit</x-ui.button>
            </div>
        </x-ui.fieldset>
    </form>
</div>
