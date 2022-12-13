<form wire:submit.prevent="changePassword">
    @csrf
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-3">
            <label for="current_password" class="form-label">Old Password</label>
            <input wire:model.defer="state.current_password" type="password"
                class="form-control @error('current_password') is-invalid @enderror" id="current_password">
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input wire:model.defer="state.password" type="password"
                class="form-control @error('password') is-invalid @enderror" id="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New
                Password</label>
            <input wire:model.defer="state.password_confirmation" type="password" class="form-control"
                id="password_confirmation">
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            <span>Submit</span>
        </button>
    </div>

</form>
