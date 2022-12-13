<x-modals.modal>
    <x-slot name="title">
        <h5 class="modal-title" id="exampleModalLabel">
            @if ($showDetailModal)
                <span>Update Personal Details</span>
            @else
                <span>Update Basic Information</span>
            @endif
        </h5>

    </x-slot>

    <x-slot name="content">
        @if ($showDetailModal)
            @include('livewire.admin.profile.formPersonal')
        @else
            @include('livewire.admin.profile.form')
        @endif

    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"
            wire:click.prevent="{{ $showDetailModal ? 'updateUserPersonal' : 'updateUserBasic' }}">
            <span>Update</span>
        </button>

    </x-slot>
</x-modals.modal>
