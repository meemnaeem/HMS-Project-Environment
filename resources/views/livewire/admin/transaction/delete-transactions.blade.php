<x-modals.multi-delete>
    <x-slot name="title">
        <h5 class="modal-title">
            Delete Selected Transactions
        </h5>

    </x-slot>

    <x-slot name="content">
        <h1>
            Are you sure to delete the selected transactions?
        </h1>
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                class="fa fa-times m-1">Cancel</i></button>
        <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i class="fa fa-trash m-1">Delete</i>
        </button>
    </x-slot>
</x-modals.multi-delete>
