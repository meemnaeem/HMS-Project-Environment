<x-modals.modal>
    <x-slot name="title">
        <h5 class="modal-title" id="exampleModalLabel">
            @if ($showEditModal)
                <span>Edit Transaction</span>
            @else
                <span>Add Transaction</span>
            @endif
        </h5>

    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.transaction.form')
    </x-slot>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"
            wire:click.prevent="{{ $showEditModal ? 'updateTransaction' : 'createTransaction' }}">
            @if ($showEditModal)
                <span>Update</span>
            @else
                <span>Save</span>
            @endif

        </button>

    </x-slot>
</x-modals.modal>
