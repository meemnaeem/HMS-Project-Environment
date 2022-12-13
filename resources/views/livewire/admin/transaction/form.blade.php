<form>
    @csrf
    <div class="mb-6">
        <label class="block">
            <span class="text-gray-700">Select Status</span>
            <select name="status" id="status" class="form-control block w-full mt-1 rounded-md" type="status"
                wire:model.defer="state.status">
                @foreach (App\Custom\Helper::getTransactionStatus() as $key => $status)
                    <option value="{{ $status }}"
                        {{ isset($transaction) ? App\Custom\Helper::Selected($status, $transaction->status) : old('status') }}>
                        {{ $status }}</option>
                @endforeach
            </select>
        </label>
    </div>
</form>


{{-- <form>
    @csrf
    <div class="mb-6">
        <label class="flex flex-col block">
            <select class="block w-full mt-1" name="status" type="status" wire:model.defer="state.status"
                class="form-control" id="status">
                <option value="Paid" {{ $transaction->status == 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>
                <option value="Due" {{ $transaction->status == 'Due' ? 'selected' : '' }}>
                    Due
                </option>
            </select>
        </label>
    </div>
</form> --}}
