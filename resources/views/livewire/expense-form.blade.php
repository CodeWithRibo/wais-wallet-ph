<div>
    <form wire:submit="save" method="POST">
        <x-ui.fieldset label="Expenses Information">

            <x-ui.field required>
                <x-ui.label>Amount</x-ui.label>
                <x-ui.input placeholder="Enter Amount"
                            type="number"
                            step="0.01"
                            wire:model="amount"/>
                <x-ui.error name="amount"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Category</x-ui.label>
                <x-ui.select
                    placeholder="Select Category"
                    wire:model="category">
                    <x-ui.select.option value="personal">Personal</x-ui.select.option>
                    <x-ui.select.option value="asdad">Personal</x-ui.select.option>

                </x-ui.select>
                <x-ui.error name="category"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Wallet</x-ui.label>
                <x-ui.select
                    placeholder="Select Wallet"
                    wire:model="wallet_type">
                    @foreach (auth()->user()->wallet as $wallet)
                        <x-ui.select.option value="{{strtolower($wallet->wallet_name)}}" icon="wallet">{{$wallet->wallet_name}}</x-ui.select.option>
                    @endforeach
                </x-ui.select>
                <x-ui.error name="wallet_type"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Date</x-ui.label>
                <x-ui.input type="date"
                            wire:model="date"
                            value="<?php echo date('Y-m-d'); ?>"/>
                <x-ui.error name="date"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Payment Method (Optional)</x-ui.label>
                <x-ui.select
                    placeholder="Select Payment Method"
                    wire:model="payment_method">
                    <x-ui.select.option value="cash">Cash</x-ui.select.option>
                    <x-ui.select.option value="gcash">Gcash</x-ui.select.option>
                    <x-ui.select.option value="maya">Maya</x-ui.select.option>
                    <x-ui.select.option value="card">Card</x-ui.select.option>
                </x-ui.select>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Notes (Optional)</x-ui.label>
                <x-ui.input type="text"
                            placeholder="e.g. Buying Big brew"
                            wire:model="notes"/>
                <x-ui.error name="notes"/>
            </x-ui.field>

            <x-ui.error name="wallet_type"/>
            <div class=" mt-5 flex items-center justify-center">
                <x-ui.button type="submit">Submit</x-ui.button>
            </div>
        </x-ui.fieldset>
    </form>
</div>
