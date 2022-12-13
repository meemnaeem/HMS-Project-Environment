<x-modals.modal>
    <x-slot name="title">
        <h5 class="modal-title" id="exampleModalLabel">
            @if ($showEditModal)
                <span>Edit User</span>
            @else
                <span>Add New User</span>
            @endif
        </h5>

    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.users.form')
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"
            wire:click.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
            @if ($showEditModal)
                <span>Update</span>
            @else
                <span>Save</span>
            @endif

        </button>

    </x-slot>
</x-modals.modal>
