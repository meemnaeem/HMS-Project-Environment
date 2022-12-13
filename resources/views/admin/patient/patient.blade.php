<div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">List of Doctors!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            <img class="rounded-circle" alt="User Image"
                                src="{{ URL::asset('doccure/admin/assets/img/patients/patient' . $patient->image) }}.jpg">
                        </a>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{ $patient->name }}</h4>
                        <h6 class="text-muted">{{ $patient->email }}</h6>
                        <div class="user-Location"><i class="fa fa-map-marker"></i> {{ $patient->home_address }}
                        </div>
                        <div class="about-text">{{ $patient->description }}</div>
                    </div>
                    <div class="col-auto profile-btn">


                        <a wire:click.prevent="edit({{ $patient->id }})" class="btn btn-primary btn-sm">Edit</a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title d-flex justify-content-between">
                        <span>Personal Details</span>

                        <a class="edit-link" data-toggle="modal" href="#edit_personal_details"
                            wire:click.prevent="editPersonal({{ Auth::user() }})"><i
                                class="fa fa-edit mr-1"></i>Edit</a>
                    </h1>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                        <p class="col-sm-10">{{ $patient->name }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of
                            Birth</p>
                        <p class="col-sm-10">{{ $patient->dob }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                        <p class="col-sm-10">{{ $patient->email }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                        <p class="col-sm-10">{{ $patient->phone }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                        <p class="col-sm-10 mb-0">{{ $patient->home_address }}
                    </div>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0">Age</p>
                        <p class="col-sm-10 mb-0">{{ $patient->age }}
                    </div>
                    <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0">Doctor</p>
                        <p class="col-sm-10 mb-0">{{ $patient->user->name }}
                    </div>
                </div>
            </div>

        </div>


    </div>


</div>
