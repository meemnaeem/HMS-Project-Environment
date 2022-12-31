<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of Reviews</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Reviews</li>
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
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Ratings</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
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
                                                                    wire:click.prevent="confirmReviewsRemoval({{ $review->id }})"
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
                                        class="{{ $selectAll == true || in_array($review->id, $checked) ? 'bg-green-100' : '' }}">
                                        <td><input type="checkbox" class="form-checkbox" value="{{ $review->id }}"
                                                wire:model="checked"> </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('admin/patient-profile', $review->patient_id) }}"
                                                    class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                                                        src="{{ URL::asset('doccure/admin/assets/img/profiles/avatar-0' . $review->patient->user->image) }}.jpg"
                                                        alt="User Image"></a>
                                                <a href="{{ url('admin/patient-profile', $review->patient_id) }}">
                                                    {{ $review->patient->first_name }}
                                                    {{ $review->patient->last_name }}
                                                    {{-- {{ $review->patient_id }} --}}
                                                </a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('admin/user', $review->doctor_id) }}"
                                                    class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                                                        src="{{ URL::asset('doccure/admin/assets/img/profiles/avatar-0' . $review->doctor->user->image) }}.jpg"
                                                        alt="User Image"></a>
                                                <a href="{{ url('admin/user', $review->doctor_id) }}">
                                                    {{ $review->doctor->user->first_name }}
                                                    {{ $review->doctor->user->last_name }}
                                                    {{-- {{ $review->user_id }} --}}
                                                </a>
                                            </h2>
                                        </td>
                                        <td class="text-warning">
                                            <i
                                                class="fe fe-star @if ($review->rating < 1) -o text-secondary @endif"></i>
                                            <i
                                                class="fe fe-star @if ($review->rating < 2) -o text-secondary @endif"></i>
                                            <i
                                                class="fe fe-star @if ($review->rating < 3) -o text-secondary @endif"></i>
                                            <i
                                                class="fe fe-star @if ($review->rating < 4) -o text-secondary @endif"></i>
                                            <i
                                                class="fe fe-star @if ($review->rating < 5) -o text-secondary @endif"></i>
                                        </td>
                                        <td>{{ Str::limit($review->description, 30) }}</td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status{{ $review->id }}"
                                                    {{ App\Custom\Helper::getStatusValue($review->status) }}
                                                    wire:click="changeStatus('{{ $review->id }}', {{ $review->status }})"
                                                    class="check">
                                                <label for="status{{ $review->id }}"
                                                    class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">
                                                <a data-toggle="modal" href="#deleteModal"
                                                    class="btn btn-sm bg-danger-light"
                                                    wire:click.prevent="confirmReviewRemoval({{ $review->id }})">
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
    @include('livewire.admin.review.addEdit-modal')
    {{-- <x-modals.addModal :data="$patient" /> --}}

    {{-- Delete modal --}}
    @include('livewire.admin.review.delete-review')
    {{-- <x-modals.delete :data="$patient" /> --}}

    @include('livewire.admin.review.delete-reviews')
    {{-- <x-modals.delete :data="$patient" /> --}}

    <!-- Edit Details Modal -->
    {{-- <x-modals.updateModal :data="$patient" /> --}}
    {{-- <x-modals.modal :data="$patient" /> --}}
</div>
