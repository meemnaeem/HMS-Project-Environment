<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of Specialities</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Specialities</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                <a href="#" wire:click.prevent="addNew" class="btn btn-primary float-right mt-2"><i
                        class="fa fa-plus-circle mr-1">Add New
                        Speciality</i></a>
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
                        <table class="datatable table table-hover table-center mb-0 ">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="selectAll" wire:model="selectAll">
                                    </th>
                                    <th>ID</th>
                                    <th>Specialities</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($specialities as $speciality)
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
                                                                    wire:click.prevent="confirmSpecialitiesRemoval({{ $speciality->id }})"
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
                                        class="{{ $selectAll == true || in_array($speciality->id, $checked) ? 'bg-green-100' : '' }}">
                                        <td><input type="checkbox" class="form-checkbox" value="{{ $speciality->id }}"
                                                wire:model="checked"> </td>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ $speciality->code }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm mr-2">
                                                    <img class="avatar-img"
                                                        src="{{ URL::asset('doccure/admin/assets/img/specialities/specialities-0' . $speciality->image) }}.png"
                                                        alt="Speciality">
                                                </a>
                                                <a href="profile.html">{{ $speciality->name }}</a>
                                            </h2>
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">
                                                <a class="btn btn-sm bg-success-light" data-toggle="modal"
                                                    href="#edit_specialities_details"
                                                    wire:click.prevent="edit({{ $speciality }})">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a data-toggle="modal" href="#deleteModal"
                                                    class="btn btn-sm bg-danger-light"
                                                    wire:click.prevent="confirmSpecialityRemoval({{ $speciality->id }})">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <x-notfound />
                                        </td>
                                        <td></td>
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
    @include('livewire.admin.speciality.addEdit-modal')
    {{-- <x-modals.addModal :data="$patient" /> --}}

    {{-- Delete modal --}}
    @include('livewire.admin.speciality.delete-speciality')
    {{-- <x-modals.delete :data="$patient" /> --}}

    @include('livewire.admin.speciality.delete-specialities')
    {{-- <x-modals.delete :data="$patient" /> --}}

    <!-- Edit Details Modal -->
    {{-- <x-modals.updateModal :data="$patient" /> --}}
    {{-- <x-modals.modal :data="$patient" /> --}}
</div>
