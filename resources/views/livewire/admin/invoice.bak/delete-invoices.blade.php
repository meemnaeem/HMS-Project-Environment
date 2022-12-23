<x-modals.multi-delete>
    <x-slot name="title">
        <h5 class="modal-title">
            Delete Selected Invoices
        </h5>

    </x-slot>

    <x-slot name="content">
        <h1>
            Are you sure to delete the selected invoices?
        </h1>
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                class="fa fa-times mr-1">Cancel</i></button>
        <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i class="fa fa-trash"><span
                    class="m-1">Delete</span></i>
        </button>
    </x-slot>
</x-modals.multi-delete>
