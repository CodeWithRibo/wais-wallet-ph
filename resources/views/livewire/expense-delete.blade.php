<div>
    <form wire:submit.prevent="delete()" method="post">
        <p>Are you sure want to delete this expense?</p>
        <div>
            <x-ui.button color="slate"
                         x-on:click="$modal.close('delete-expense')">
                No
            </x-ui.button>
            <x-ui.button color="red" type="submit">Yes</x-ui.button>
        </div>
    </form>
</div>
