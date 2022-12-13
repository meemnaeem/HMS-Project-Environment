<x-modals.delete>
    <x-slot name="title">
        <h5 class="modal-title">
            Delete Patient
        </h5>

    </x-slot>

    <x-slot name="content">
        <h1>
            Are you sure to delete the patient?
        </h1>
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                class="fa fa-times mr-1">Cancel</i></button>
        <button type="button" wire:click.prevent="deletePatient" class="btn btn-danger"><i
                class="fa fa-trash mr-1">Delete</i>
        </button>
    </x-slot>
</x-modals.delete>
