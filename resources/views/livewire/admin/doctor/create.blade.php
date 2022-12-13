<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">about_doctor:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter About Doctor"
            wire:model="about_doctor">
        @error('about_doctor')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">charge:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" wire:model="charge"
            placeholder="Enter charge"></input>
        @error('charge')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">specialist_id:</label>
        <input type="text" class="form-control" id="exampleFormControlInput3" wire:model="specialist_id"
            placeholder="Enter specialist_id"></input>
        @error('specialist_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput4">user_id:</label>
        <input type="text" class="form-control" id="exampleFormControlInput4" wire:model="user_id"
            placeholder="Enter user_id"></input>
        @error('user_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput5">created_by_id:</label>
        <input type="text" class="form-control" id="exampleFormControlInput5" wire:model="created_by_id"
            placeholder="Enter created_by_id"></input>
        @error('created_by_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput6">updated_by_id:</label>
        <input type="text" class="form-control" id="exampleFormControlInput6" wire:model="updated_by_id"
            placeholder="Enter updated_by_id"></input>
        @error('updated_by_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput7">experience:</label>
        <input type="text" class="form-control" id="exampleFormControlInput7" wire:model="experience"
            placeholder="Enter experience"></input>
        @error('experience')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
</form>
