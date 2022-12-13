<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of Invoices</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Invoices</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                <a href="#" wire:click.prevent="addNew" class="btn btn-primary float-right mt-2"><i
                        class="fa fa-plus-circle mr-1">Add New
                        Invoice</i></a>
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
                                    <th>Invoice Number</th>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Description</th>
                                    <th>Total Amount</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
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
                                                                    wire:click.prevent="confirmInvoicesRemoval({{ $invoice->id }})"
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
                                        class="{{ $selectAll == true || in_array($invoice->id, $checked) ? 'bg-green-100' : '' }}">
                                        <td><input type="checkbox" class="form-checkbox" value="{{ $invoice->id }}"
                                                wire:model="checked"> </td>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->patient_id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="#" class="avatar avatar-sm mr-2"><img
                                                        class="avatar-img rounded-circle"
                                                        src="{{ URL::asset('doccure/admin/assets/img/patients/patient' . $invoice->patient->image) }}.jpg"
                                                        alt="User Image"></a>
                                                <a href="#">{{ $invoice->patient->name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ Str::limit($invoice->description, 30) }}</td>
                                        <td>{{ $invoice->amount }}</td>
                                        <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                        <td>
                                            <span
                                                class="badge badge-pill inv-badge {{ $invoice->status == 'Paid' ? 'bg-success' : 'bg-danger' }}"><a
                                                    href="#edit_transactions_details"
                                                    wire:click.prevent="edit({{ $invoice }})">{{ $invoice->status }}</a></span>
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">
                                                <a class="btn btn-sm bg-success-light" data-toggle="modal"
                                                    href="#edit_invoices_details"
                                                    wire:click.prevent="edit({{ $invoice }})">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a data-toggle="modal" href="#deleteModal"
                                                    class="btn btn-sm bg-danger-light"
                                                    wire:click.prevent="confirmInvoiceRemoval({{ $invoice->id }})">
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
    @include('livewire.admin.invoice-report.addEdit-modal')
    {{-- <x-modals.addModal :data="$invoice" /> --}}

    {{-- Delete modal --}}
    @include('livewire.admin.invoice-report.delete-invoice-report')
    {{-- <x-modals.delete :data="$invoice" /> --}}

    @include('livewire.admin.invoice-report.delete-invoice-reports')
    {{-- <x-modals.delete :data="$invoice" /> --}}

    <!-- Edit Details Modal -->
    {{-- <x-modals.updateModal :data="$invoice" /> --}}
    {{-- <x-modals.modal :data="$invoice" /> --}}
</div>
