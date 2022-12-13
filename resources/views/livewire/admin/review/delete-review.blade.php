<x-modals.delete>
    <x-slot name="title">
        Delete Review
    </x-slot>

    <x-slot name="content">
        Are you sure to delete review?
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"><span
                    class="m-1">Cancel</span></i></button>
        <button type="button" wire:click.prevent="deleteReview" class="btn btn-danger"><i class="fa fa-trash mr-1"><span
                    class="m-1">Delete</span></i>
        </button>
    </x-slot>
</x-modals.delete>
