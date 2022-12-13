<x-modals.multi-delete>
    <x-slot name="title">
        <h5 class="modal-title">
            Delete Selected Reviews
        </h5>

    </x-slot>

    <x-slot name="content">
        <h1>
            Are you sure to delete the selected reviews?
        </h1>
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"><span
                    class="m-1">Cancel</span></i></button>
        <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i class="fa fa-trash"><span
                    class="m-1">Delete</span></i>
        </button>
    </x-slot>
</x-modals.multi-delete>
