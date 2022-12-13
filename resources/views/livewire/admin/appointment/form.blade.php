<form>
    @csrf
    <div class="mb-3">
        <label for="patient_id" class="form-label">patient_id</label>
        <input type="text" wire:model.defer="state.patient_id"
            class="form-control @error('patient_id') is-invalid @enderror" id="patient_id"
            aria-describedby="patient_idHelp" placeholder="Enter your patient_id">
        @error('patient_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">user_id</label>
        <input type="email" wire:model.defer="state.user_id"
            class="form-control @error('user_id') is-invalid @enderror" id="user_id" aria-describedby="user_idHelp"
            placeholder="Enter your user_id">
        @error('user_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">date</label>
        <input type="date" wire:model.defer="state.date" class="form-control @error('date') is-invalid @enderror"
            id="date" placeholder="Enter your date">
        @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">status</label>
        <input type="status" wire:model.defer="state.status" class="form-control @error('status') is-invalid @enderror"
            id="status" placeholder="Enter your status">
        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</form>
