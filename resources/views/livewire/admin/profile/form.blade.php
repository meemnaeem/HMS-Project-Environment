<form>
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror"
            id="name" aria-describedby="nameHelp" placeholder="Enter your name">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="address_1" class="form-label">Address</label>
        <input type="text" wire:model.defer="state.address_1"
            class="form-control @error('address_1') is-invalid @enderror" id="address_1"
            placeholder="Enter your address">
        @error('address_1')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea type="text" wire:model.defer="state.description"
            class="form-control @error('description') is-invalid @enderror" id="description"
            placeholder="Enter your description">
        </textarea>
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</form>
