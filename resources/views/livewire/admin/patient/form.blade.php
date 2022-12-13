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
        <label for="email" class="form-label">Email</label>
        <input type="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror"
            id="email" aria-describedby="emailHelp" placeholder="Enter email">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">phone</label>
        <input type="text" wire:model.defer="state.phone" class="form-control @error('phone') is-invalid @enderror"
            id="phone" aria-describedby="phoneHelp" placeholder="Enter phone">
        @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</form>
