<div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ($updateMode)
        @include('livewire.admin.doctor.update')
    @else
        @include('livewire.admin.doctor.create')
    @endif

    <div class="card">
        <div class="card-body">
            <div>
                <table class="datatable table table-hover table-center mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>about_doctor</th>
                            <th>charge</th>
                            <th>experience</th>
                            <th>user_id</th>
                            <th>specialist_id</th>
                            <th>created_by_id</th>
                            <th>updated_by_id</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->id }}</td>
                                <td>
                                    {{ $doctor->about_doctor }}</td>
                                <td>{{ $doctor->charge }}</td>
                                <td>
                                    {{ $doctor->experience }}</td>
                                <td>{{ $doctor->user_id }}</td>
                                <td>{{ $doctor->specialist_id }}</td>
                                <td>{{ $doctor->created_by_id }}</td>
                                <td>{{ $doctor->updated_by_id }}</td>

                                <td>
                                    <button wire:click="edit({{ $doctor->id }})"
                                        class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $doctor->id }})"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
