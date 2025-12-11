<div>
    <form wire:submit.prevent="delete()" method="post">
        <p class="pb-2">Are you sure want to delete this category?</p>
        <div class="flex items-center justify-end space-x-3">
            <x-ui.button color="slate"
                         x-on:click="$modal.close('delete-category-modal')">
                No
            </x-ui.button>
            <x-ui.button color="red" type="submit">Yes, Delete it!</x-ui.button>
        </div>
    </form>
</div>
