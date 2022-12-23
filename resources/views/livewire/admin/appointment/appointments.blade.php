<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of appointments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Appointments</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                <a href="#" wire:click.prevent="addNew" class="btn btn-primary float-right mt-2"><i
                        class="fa fa-plus-circle mr-1">Add
                        Appointment</i></a>
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
                                    <th>Doctor Name</th>
                                    <th>Patient Name</th>
                                    <th>date</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
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
                                                                    wire:click.prevent="confirmAppointmentsRemoval({{ $appointment->id }})"
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
                                        class="{{ $selectAll == true || in_array($appointment->id, $checked) ? 'bg-green-100' : '' }}">
                                        <td><input type="checkbox" class="form-checkbox" value="{{ $appointment->id }}"
                                                wire:model="checked"> </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('admin/user', $appointment->user->id) }}"
                                                    class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                                                        src="{{ URL::asset('doccure/admin/assets/img/profiles/avatar-0' . $appointment->user->image) }}.jpg"
                                                        alt="User Image"></a>
                                                <a
                                                    href="{{ url('admin/user', $appointment->user->id) }}">{{ $appointment->user->name }}</a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('admin/user', $appointment->patient->id) }}"
                                                    class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                                                        src="{{ URL::asset('doccure/admin/assets/img/patients/patient' . $appointment->patient->image) }}.jpg"
                                                        alt="User Image"></a>
                                                <a
                                                    href="{{ url('admin/patient-profile', $appointment->patient->id) }}">{{ $appointment->patient->name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $appointment->date }}</td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status{{ $appointment->id }}"
                                                    {{ App\Custom\Helper::getStatusValue($appointment->status) }}
                                                    wire:click="changeStatus('{{ $appointment->id }}', {{ $appointment->status }})"
                                                    class="check">
                                                <label for="status{{ $appointment->id }}"
                                                    class="checktoggle">checkbox</label>
                                            </div>
                                        </td>

                                        <td class="text-right">
                                            <div class="actions">
                                                <a class="btn btn-sm bg-success-light" data-toggle="modal"
                                                    href="#edit_specialities_details"
                                                    wire:click.prevent="edit({{ $appointment }})">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a data-toggle="modal" href="#deleteModal"
                                                    class="btn btn-sm bg-danger-light"
                                                    wire:click.prevent="confirmAppointmentRemoval({{ $appointment->id }})">
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
    @include('livewire.admin.appointment.addEdit-modal')
    {{-- <x-modals.addModal :data="$patient" /> --}}

    {{-- Delete modal --}}
    @include('livewire.admin.appointment.delete-appointment')
    {{-- <x-modals.delete :data="$patient" /> --}}

    @include('livewire.admin.appointment.delete-appointments')
    {{-- <x-modals.delete :data="$patient" /> --}}

    <!-- Edit Details Modal -->
    {{-- <x-modals.updateModal :data="$patient" /> --}}
    {{-- <x-modals.modal :data="$patient" /> --}}
</div>
