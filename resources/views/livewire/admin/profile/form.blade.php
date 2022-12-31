<div>
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="multi-wizard-step">
                <a href="#step-1" type="button" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">Step
                    1</a>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">Step
                    2</a>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}"
                    disabled="disabled">Step 3</a>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
        <div class="col-md-12">

            {{-- <h3> Step 1</h3> --}}
            @csrf
            <input type="hidden" wire:model.defer="userarr.id" name="id" value="{{ $user->id }}">
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" wire:model.defer="userarr.first_name" name="first_name" value="first_name"
                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                        aria-describedby="first_nameHelp" placeholder="Enter your first_name">
                    @error('first_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" wire:model.defer="userarr.last_name" name="last_name" value="last_name"
                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        aria-describedby="last_nameHelp" placeholder="Enter your last_name">
                    @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" wire:model.defer="userarr.email"
                    class="form-control @error('email') is-invalid @enderror" id="email"
                    aria-describedby="emailHelp" placeholder="Enter email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="description" class="form-label">Description</label>
                <textarea type="text" wire:model.defer="userarr.description" name="description" value="description"
                    class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="descriptionHelp"
                    placeholder="Enter user description"></textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" wire:model.defer="userarr.password"
                    class="form-control @error('password') is-invalid @enderror" id="password"
                    aria-describedby="passwordHelp" placeholder="Enter password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input wire:model.defer="userarr.password_confirmation" type="password" class="form-control"
                    id="password_confirmation" placeholder="Confirm your password">
            </div> --}}
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        {{-- <h3> Step 2</h3> --}}
        <div class="row mt-3 mb-3">
            <div class="grid grid-cols-6 gap-1">
                <div>
                    <label for="image" class="form-label">Image:</label>
                </div>
                <div class="col-span-3">
                    @if ($oldImage)
                        <img class="w-16 h-16" src="{{ Storage::url($oldImage) }}">
                    @endif
                </div>
                <div>
                    @if ($newImage)
                        Photo Preview:
                    @endif
                </div>
                <div>
                    @if ($newImage)
                        <img class="w-16 h-16" src="{{ $newImage->temporaryUrl() }}">
                    @endif
                </div>
            </div>
            <input type="file" wire:model.defer="newImage" value="{{ $user->image }}"
                class="form-control @error('newImage') is-invalid @enderror" id="image"
                aria-describedby="imageHelp">
            @error('newImage')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">phone</label>
                <input type="text" wire:model.defer="userarr.phone"
                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                    aria-describedby="phoneHelp" placeholder="Enter phone">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" wire:model.defer="userarr.age" name="age" value="age"
                    class="form-control @error('age') is-invalid @enderror" id="age" aria-describedby="ageHelp"
                    placeholder="Enter your age">
                @error('age')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div>
                <label for="address_1" class="form-label">Address</label>
                <input type="text" wire:model.defer="userarr.address_1"
                    class="form-control @error('address_1') is-invalid @enderror" id="address_1"
                    aria-describedby="addressHelp" placeholder="Enter address_1">
                @error('address_1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
        <div class="col-md-12 mt-3">
            {{-- <h3> Step 3</h3> --}}
            <table class="table">
                @foreach ($userarr as $key => $value)
                    @if ($key == 'first_name' or
                        $key == 'last_name' or
                        $key == 'email' or
                        $key == 'description' or
                        $key == 'image' or
                        $key == 'phone' or
                        $key == 'address_1' or
                        $key == 'age')
                        <tr>
                            <td>{{ strtoupper(str_replace('_', ' ', $key)) }}:</td>
                            <td><strong><?php echo $value; ?></strong></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</div>
