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
                <x-select-option
                    wire:model="category"
                    :options="[
                            '' => 'Select Category',
                            'Transportation' => 'Transportation',
                            'HealthCare' => 'HealthCare',
                            ]">
                </x-select-option>
                <x-ui.error name="category"/>
            </x-ui.field>
            @php
                $walletNames = $user->wallet->pluck('wallet_name')->mapWithKeys(fn($v) => [$v => $v]);
            @endphp
            <x-ui.field required>
                <x-ui.label>Wallet</x-ui.label>
                <x-select-option
                    wire:model="wallet_type"
                    :options="array_merge(['' => 'Select Wallet'], $walletNames->toArray())">
                </x-select-option>
                <x-ui.error name="wallet_type"/>
            </x-ui.field>
            <x-ui.field required>
                <x-ui.label>Date</x-ui.label>
                <x-ui.input type="date"
                            wire:model="date"/>
                <x-ui.error name="date"/>
            </x-ui.field>

            <x-ui.field>
                <x-ui.label>Payment Method (Optional)</x-ui.label>
                <x-select-option
                    wire:model="payment_method"
                    :options="[
                            '' => 'Select Payment Method',
                            'Cash' => 'Cash',
                            'Maya' => 'Maya',
                            'Gcash' => 'Gcash',
                            'Card' => 'Card',
                            ]">
                </x-select-option>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Notes (Optional)</x-ui.label>
                <x-ui.input type="text"
                            placeholder="e.g. Buying Big brew"
                            wire:model="notes"/>
            </x-ui.field>
            <div class=" mt-5 flex items-center justify-center">
                <x-ui.button type="submit">Submit</x-ui.button>
            </div>
        </x-ui.fieldset>
    </form>
</div>
