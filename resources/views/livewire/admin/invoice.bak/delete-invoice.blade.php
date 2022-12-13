<x-modals.delete>
    <x-slot name="title">
        Delete Invoice
    </x-slot>

    <x-slot name="content">
        Are you sure to delete invoice?
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                class="fa fa-times m-1">Cancel</i></button>
        <button type="button" wire:click.prevent="deleteInvoice" class="btn btn-danger"><i
                class="fa fa-trash m-1">Delete</i>
        </button>
    </x-slot>
</x-modals.delete>
