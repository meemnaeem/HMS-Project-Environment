<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                {{-- <h3 class="page-title">Human Resource</h3> --}}
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">HR</li>
                    <li class="breadcrumb-item active">
                        {{ Request()->segment(1) ? Str::upper(Request()->segment(1)) : 'Users' }}</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                <a href="{{ route('admin.hr.create') }}" class="btn btn-primary float-right mt-2">Add User</a>
            </div>
        </div>
    </div>




    @include('backend.admins.users.header')

    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-center float-left pr-2">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <label for="perPage" class="text-sm font-medium">
                        Per Page
                    </label>
                    <x-selectbox wire="perPage" name=""
                        class="h-8 text-sm pr-8 pl-1 text-center leading-none transition duration-75 border-gray-200 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600">
                        @foreach (App\Custom\Helper::getPerPageNumber() as $key => $perpage)
                            <option value="{{ $key }}">{{ $loop->first ? $perpage : $key }}</option>
                        @endforeach
                    </x-selectbox>
                    <label for="perPage" class="text-sm font-medium">
                        Sort By
                    </label>
                    <x-selectbox wire="sortBy" name=""
                        class="h-8 w-24 text-sm pr-8 pl-1 text-center leading-none transition duration-75 border-gray-200 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600">
                        <option value="asc">Asc</option>
                        <option value="desc">Desc</option>
                    </x-selectbox>
                </div>
            </div>
            <div class="flex float-right">
                <x-searchbox name="search" placeholder="" />
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-hover table-center mb-0">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectAll" wire:model="selectAll"> </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($checked) > 0)
                        <tr class="bg-pink-100">
                            <td colspan="12">
                                <div class="row">
                                    <div class="col-md-9 pull-left">
                                        You have selected ({{ count($checked) }})
                                        {{ Str::plural('Row', count($checked)) }}
                                        &nbsp; Do you want to select all? &nbsp;
                                        <a href="javascript:()" wire:click="SelectAllRecord()">Yes</a>
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-flat btn-sm" wire:click="BulkExport()"><i
                                                    class="fa fa-file-excel-o m-1"></i>Bulk Export</button>
                                            <button class="btn btn-danger btn-flat btn-sm"
                                                wire:click="deleteId({{ $user->id }})" data-toggle="modal"
                                                data-target="#deleteModal"><i class="fa fa-trash m-1"></i>Bulk
                                                Delete</button>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endif

                    @forelse ($users as $user)
                        <tr class="{{ $selectAll == true || in_array($user->id, $checked) ? 'bg-green-100' : '' }}">
                            <td><input type="checkbox" class="form-checkbox" value="{{ $user->id }}"
                                    wire:model="checked"> </td>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="#" class="avatar avatar-sm mr-2">
                                        <img src="{{ URL::asset('doccure/admin/assets/img/profiles/avatar-0' . $user->image) }}.jpg"
                                            width="50" class="avatar-img rounded-circle" alt="">
                                    </a>
                                    <a href="#">{{ $user->name }} <span>
                                            @foreach ($user->getRoleNames() as $role)
                                                {{ Str::ucfirst(str_replace('-', ' ', $role)) }}
                                            @endforeach
                                        </span></a>
                                </h2>
                                <a href="" wire:click.prevent="startConversation({{ $user->id }})"
                                    class="text-secondary"><i class="fa fa-comments"></i></a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ App\Custom\Helper::getGenderValue($user->gender) }}</td>
                            {{-- <td>{{ App\Custom\Helper::getStatusValue($user->status) }}</td> --}}
                            <td>
                                <div class="status-toggle">
                                    <input type="checkbox" id="status{{ $user->id }}"
                                        {{ App\Custom\Helper::getStatusValue($user->status) }}
                                        wire:click="changeStatus('{{ $user->id }}', {{ $user->status }})"
                                        class="check">
                                    <label for="status{{ $user->id }}" class="checktoggle">checkbox</label>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.hr.edit', [$user->id]) }}"><i
                                            class="fa fa-edit fa-x2 px-2"></i></a>
                                    <a href="#" wire:click.prevent="deleteId({{ $user->id }})"
                                        data-toggle="modal" data-target="#deleteModal"><i
                                            class="fa fa-trash text-danger"></i></a>

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
        @if (!empty($users))
            <div class="card-footer">
                {{-- {{ $users->links() }} --}}
            </div>
        @endif
    </div>
    <x-modals.delete :data="$user" />


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
