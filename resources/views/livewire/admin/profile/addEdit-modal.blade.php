<x-modals.modal>
    <x-slot name="title">
        <h5 class="modal-title" id="exampleModalLabel">
            <span>Edit User</span>
        </h5>
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.user-profile.form')
    </x-slot>

    <x-slot name="buttons">
        <div class="{{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
            <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                type="button">Next</button>
        </div>
        <div class="{{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"
                wire:click="secondStepSubmit">Next</button>
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
        </div>
        <div class="{{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
            <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
        </div>
    </x-slot>
</x-modals.modal>
