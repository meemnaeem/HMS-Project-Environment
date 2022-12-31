<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of Transactions</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ul>
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
                                    <th>Invoice Number</th>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Description</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
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
                                                                    wire:click.prevent="confirmTransactionsRemoval({{ $transaction->id }})"
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
                                        class="{{ $selectAll == true || in_array($transaction->id, $checked) ? 'bg-green-100' : '' }}">
                                        <td><input type="checkbox" class="form-checkbox" value="{{ $transaction->id }}"
                                                wire:model="checked"> </td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->patient_id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('admin/patient-profile', $transaction->patient_id) }}"
                                                    class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                                                        src="{{ URL::asset('doccure/admin/assets/img/patients/patient' . $transaction->patient->image) }}.jpg"
                                                        alt="User Image"></a>
                                                <a href="{{ url('admin/patient-profile', $transaction->patient_id) }}">
                                                    {{ $transaction->patient->first_name }}
                                                    {{ $transaction->patient->last_name }}
                                                    {{-- {{ $transaction->patient_id }} --}}
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ Str::limit($transaction->description, 30) }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>
                                            <span
                                                class="badge badge-pill inv-badge {{ $transaction->status == 'Paid' ? 'bg-success' : 'bg-danger' }}"><a
                                                    href="#edit_transactions_details"
                                                    wire:click.prevent="edit({{ $transaction }})">{{ $transaction->status }}</a></span>
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">
                                                <a data-toggle="modal" href="#deleteModal"
                                                    class="btn btn-sm bg-danger-light"
                                                    wire:click.prevent="confirmTransactionRemoval({{ $transaction->id }})">
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
    @include('livewire.admin.transaction.addEdit-modal')
    {{-- <x-modals.addModal :data="$patient" /> --}}

    {{-- Delete modal --}}
    @include('livewire.admin.transaction.delete-transaction')
    {{-- <x-modals.delete :data="$patient" /> --}}

    @include('livewire.admin.transaction.delete-transactions')
    {{-- <x-modals.delete :data="$patient" /> --}}

    <!-- Edit Details Modal -->
    {{-- <x-modals.updateModal :data="$patient" /> --}}
    {{-- <x-modals.modal :data="$patient" /> --}}
</div>
