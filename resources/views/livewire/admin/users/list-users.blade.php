<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of Doctors</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                <a href="#" wire:click.prevent="addNew" class="btn btn-primary float-right mt-2"><i
                        class="fa fa-plus-circle mr-1">Add New
                        User</i></a>
            </div>

        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="flex float-right">
                            <x-searchbox name="search" placeholder="" />
                        </div>
                        <table class="datatable table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="selectAll" wire:model="selectAll"> </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    @if ($loop->first)
                                        @if (count($checked) > 1)
                                            <tr class="bg-pink-100">
                                                <td colspan="12">
                                                    <div class="row">
                                                        <div class="col-md-9 pull-left">
                                                            You have selected ({{ count($checked) }})
                                                            {{ Str::plural('Row', count($checked)) }}
                                                            &nbsp; Do you want to select all? &nbsp;
                                                            <a href="javascript:()"
                                                                wire:click="SelectAllRecord()">Yes</a>
                                                        </div>
                                                        <div class="col-md-3 pull-right">
                                                            <div class="btn-group">
                                                                <button class="btn btn-success btn-flat btn-sm"
                                                                    wire:click="BulkExport()"><i
                                                                        class="fa fa-file-excel-o m-1"></i>Bulk
                                                                    Export</button>

                                                                <a class="btn btn-danger btn-flat btn-sm"
                                                                    wire:click.prevent="confirmUsersRemoval({{ $user->id }})"
                                                                    data-toggle="modal" data-target="#deleteModal"><i
                                                                        class="fa fa-trash m-1"></i>Bulk
                                                                    Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endif
                                    @endif

                                    <tr
                                        class="{{ $selectAll == true || in_array($user->id, $checked) ? 'bg-green-100' : '' }}">
                                        <td><input type="checkbox" class="form-checkbox" value="{{ $user->id }}"
                                                wire:model="checked"> </td>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            {{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status{{ $user->id }}"
                                                    {{ App\Custom\Helper::getStatusValue($user->status) }}
                                                    wire:click="changeStatus('{{ $user->id }}', {{ $user->status }})"
                                                    class="check">
                                                <label for="status{{ $user->id }}"
                                                    class="checktoggle">checkbox</label>
                                            </div>
                                        </td>

                                        <td class="text-right">
                                            <div class="actions">
                                                <a class="btn btn-sm bg-success-light" data-toggle="modal"
                                                    href="#edit_specialities_details"
                                                    wire:click.prevent="edit({{ $user }})">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a data-toggle="modal" href="#deleteModal"
                                                    class="btn btn-sm bg-danger-light"
                                                    wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12">
                                            <x-notfound />
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Modal -->
    @include('livewire.admin.users.addEdit-modal')
    {{-- <x-modals.addModal :data="$patient" /> --}}

    {{-- Delete modal --}}
    @include('livewire.admin.users.delete-user')
    {{-- <x-modals.delete :data="$patient" /> --}}

    @include('livewire.admin.users.delete-users')
    {{-- <x-modals.delete :data="$patient" /> --}}

    <!-- Edit Details Modal -->
    {{-- <x-modals.updateModal :data="$patient" /> --}}
    {{-- <x-modals.modal :data="$patient" /> --}}
</div>
