<form>
    @csrf
    <div class="mb-3">
        <label for="dob" class="form-label">dob</label>
        <input type="date" wire:model.defer="state.dob" class="form-control @error('dob') is-invalid @enderror"
            id="dob" placeholder="Enter your dob">
        @error('dob')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">phone</label>
        <input type="text" wire:model.defer="state.phone" class="form-control @error('phone') is-invalid @enderror"
            id="phone" placeholder="Enter your phone">
        @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</form>
