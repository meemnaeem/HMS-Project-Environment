<x-modals.modal>
    <x-slot name="title">
        <h5 class="modal-title" id="exampleModalLabel">
            @if ($showEditModal)
                <span>Edit Appointment</span>
            @else
                <span>Add New Appointment</span>
            @endif
        </h5>

    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.appointment.form')
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"
            wire:click.prevent="{{ $showEditModal ? 'updateAppointment' : 'createAppointment' }}">
            @if ($showEditModal)
                <span>Update</span>
            @else
                <span>Save</span>
            @endif

        </button>

    </x-slot>
</x-modals.modal>
