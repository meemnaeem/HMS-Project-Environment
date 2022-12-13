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
        <label for="amount" class="form-label">amount</label>
        <input type="text" wire:model.defer="state.amount" class="form-control @error('amount') is-invalid @enderror"
            id="amount" aria-describedby="amountHelp" placeholder="Enter amount">
        @error('amount')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <input type="text" wire:model.defer="state.description"
            class="form-control @error('description') is-invalid @enderror" id="description"
            aria-describedby="descriptionHelp" placeholder="Enter description">
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-6">
        <label class="block">
            <span class="text-gray-700">Select Status</span>
            <select name="status" id="status" class="form-control block w-full mt-1 rounded-md" type="status"
                wire:model.defer="state.status">
                @foreach (App\Custom\Helper::getTransactionStatus() as $key => $status)
                    <option value="{{ $status }}"
                        {{ isset($invoice) ? App\Custom\Helper::Selected($status, $invoice->status) : old('status') }}>
                        {{ $status }}</option>
                @endforeach
            </select>
        </label>
    </div>
</form>
