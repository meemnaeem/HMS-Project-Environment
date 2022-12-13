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
        <label for="email" class="form-label">Email address</label>
        <input type="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror"
            id="email" aria-describedby="emailHelp" placeholder="Enter your email">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" wire:model.defer="state.password"
            class="form-control @error('password') is-invalid @enderror" id="password"
            placeholder="Enter your password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="passwordConfirmation" class="form-label">Confirm Password</label>
        <input type="password" wire:model.defer="state.password_confirmation" class="form-control"
            id="passwordConfirmation" placeholder="Confirm your password">
    </div>
</form>
