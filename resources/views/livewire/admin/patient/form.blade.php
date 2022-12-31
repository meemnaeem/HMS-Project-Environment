<div>
    {{-- @if (!empty($successMsg))
        <div class="alert alert-success">
            {{ $successMsg }}
        </div>
    @endif --}}
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
            @if ($showEditModal)
                <input type="hidden" wire:model.defer="patientarr.id" name="id" value="{{ $patient->id }}">
            @endif

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
            <div class="mb-3">
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
            @if (!$showEditModal)
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input wire:model.defer="userarr.password_confirmation" type="password" class="form-control"
                        id="password_confirmation" placeholder="Confirm your password">
                </div>
            @endif
            {{-- <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                type="button">Next</button> --}}
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        <div class="col-md-12">
            {{-- <h3> Step 2</h3> --}}
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" wire:model.defer="patientarr.first_name" name="first_name"
                    value="userarr.first_name" class="form-control @error('first_name') is-invalid @enderror"
                    id="first_name" aria-describedby="first_nameHelp" placeholder="Enter your first_name">
                @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" wire:model.defer="patientarr.last_name" name="last_name" value="userarr.last_name"
                    class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                    aria-describedby="last_nameHelp" placeholder="Enter your last_name">
                @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">phone</label>
                <input type="text" wire:model.defer="patientarr.phone"
                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                    aria-describedby="phoneHelp" placeholder="Enter phone">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" wire:model.defer="patientarr.image"
                    class="form-control @error('image') is-invalid @enderror" id="image aria-describedby="imageHelp"
                    placeholder="Enter image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" wire:model.defer="patientarr.age" name="age" value="{{ old('age') }}"
                    class="form-control @error('age') is-invalid @enderror" id="age" aria-describedby="ageHelp"
                    placeholder="Enter your age">
                @error('age')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address_1" class="form-label">Address</label>
                <input type="text" wire:model.defer="patientarr.address_1"
                    class="form-control @error('address_1') is-invalid @enderror" id="address_1"
                    aria-describedby="addressHelp" placeholder="Enter address_1">
                @error('address_1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"
                wire:click="secondStepSubmit">Next</button> --}}
            {{-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button> --}}

            {{-- <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                wire:click="back(1)">Back</button> --}}
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
        <div class="col-md-12">
            {{-- <h3> Step 3</h3> --}}
            <table class="table">
                {{-- @foreach ($userarr as $key => $value)
                    <tr>
                        <td>{{ $key }}:</td>
                        <td id="patientname">{{ $value }}</td>
                    </tr>
                @endforeach --}}
                @foreach ($userarr as $key => $value)
                    @if ($key == 'email')
                        <tr>
                            <td>{{ $key }}:</td>
                            <td><strong><?php echo $value; ?></strong></td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($patientarr as $key => $value)
                    @if ($key == 'name' or $key == 'image' or $key == 'phone' or $key == 'address_1' or $key == 'age')
                        <tr>
                            <td>{{ $key }}:</td>
                            <td><strong><?php echo $value; ?></strong></td>
                        </tr>
                    @endif
                @endforeach
            </table>
            {{-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                wire:click="back(2)">Back</button> --}}
        </div>
    </div>
</div>
