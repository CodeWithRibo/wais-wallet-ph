<div>
    <form wire:submit="save" method="POST">
        <x-ui.fieldset label="Category Information">
            <x-ui.field required>
                <x-ui.label>Category Name</x-ui.label>
                <x-ui.input placeholder="Enter Category"
                            wire:model="category_name"/>
                <x-ui.error name="category_name"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Monthly Budget</x-ui.label>
                <x-ui.input placeholder="Enter Budget"
                            type="number"
                            step="0.01"
                            wire:model="monthly_budget"/>
                <x-ui.error name="monthly_budget"/>
            </x-ui.field>

            @php
                $category = \App\Models\Category::pluck('category_type')->mapWithKeys(fn($v) => [$v => $v]);
            @endphp
            <x-ui.field required>
                <x-ui.label>Category Type</x-ui.label>
                <x-select-option
                    wire:model="category_type"
                    :options="array_merge(['' => 'Select Wallet'], $category->toArray())">
                </x-select-option>
                <x-ui.error name="category_type"/>
            </x-ui.field>

            <div class=" mt-5 flex items-center justify-center">
                <x-ui.button type="submit">Submit</x-ui.button>
            </div>
        </x-ui.fieldset>
    </form>
</div>
