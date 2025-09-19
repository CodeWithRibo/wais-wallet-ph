<div>
    <flux:modal.trigger name="edit-profile">
        <flux:button>Add Wallet</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Wallet</flux:heading>
            </div>

            <form wire:submit="save()" method="post">
                <flux:input wire:model="wallet_name" class="@error('wallet_name') is-invalid @enderror"
                            label="Wallet Name" placeholder="Enter Wallet Name"/>
                <flux:input wire:model="current_balance" type="number" class="@error('current_balance') is-invalid @enderror"
                            label="Current Balance" placeholder="Enter Current Balance"/>

                <flux:select wire:model="wallet_type">
                    <flux:select.option disabled selected>Select Wallet</flux:select.option>
                    <flux:select.option value="personal">personal</flux:select.option>
                    <flux:select.option value="business">Business</flux:select.option>
                    <flux:select.option value="shared">Shared</flux:select.option>

                </flux:select>

                <div class="flex">
                    <flux:spacer/>
                    <flux:button type="submit" variant="primary">Submit</flux:button>
                </div>
            </form>


        </div>
    </flux:modal>
</div>
