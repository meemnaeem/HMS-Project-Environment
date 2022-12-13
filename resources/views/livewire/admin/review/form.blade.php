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
        <label for="rating" class="form-label">rating</label>
        <input type="text" wire:model.defer="state.rating" class="form-control @error('rating') is-invalid @enderror"
            id="rating" aria-describedby="ratingHelp" placeholder="Enter your rating">
        @error('rating')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <input type="text" wire:model.defer="state.description"
            class="form-control @error('description') is-invalid @enderror" id="description"
            aria-describedby="descriptionHelp" placeholder="Enter your description">
        @error('description')
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
</form>
