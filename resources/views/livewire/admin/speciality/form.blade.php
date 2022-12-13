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
        <label for="code" class="form-label">Code</label>
        <input type="text" wire:model.defer="state.code" class="form-control @error('code') is-invalid @enderror"
            id="code" aria-describedby="codeHelp" placeholder="Enter code">
        @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</form>
