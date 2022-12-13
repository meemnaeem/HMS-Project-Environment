<div class="card">
    <div class="card-header">
        Header
    </div>
    <div class="card-body bg-white" style="background: white">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" class="form-label">Title</label>
                    <select name="title" id="title" class="form-control">
                        @foreach (App\Custom\Helper::getTitle() as $key => $title)
                            <option value="{{ $key }}"
                                {{ isset($user) ? App\Custom\Helper::Selected($key, $user->title) : old('title') }}>
                                {{ $title }}
                            </option>
                        @endforeach



                        {{-- <option value="1">Mr</option>
                        <option value="2">Dr</option>
                        <option value="3">Mrs</option> --}}
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="" class="form-label">Full Name</label>
                    <input type="text" value="{{ isset($user) ? $user->name : old('name') }}" class="form-control"
                        name="name" id="name" placeholder="Enter full name">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="" class="form-label">Username</label>
                    <input type="text" value="{{ isset($user) ? $user->username : old('username') }}"
                        class="form-control" name="username" id="username" placeholder="Enter username">
                </div>
            </div>
        </div>

        {{-- step 2 --}}
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        @foreach (App\Custom\Helper::getGender() as $key => $gender)
                            <option value="{{ $key }}"
                                {{ isset($user) ? App\Custom\Helper::Selected($key, $user->gender) : old('gender') }}>
                                {{ $gender }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="Email" value="{{ isset($user) ? $user->email : old('email') }}" class="form-control"
                        name="email" id="email" placeholder="Enter email">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="" class="form-label">Phone</label>
                    <input type="text" value="{{ isset($user) ? $user->phone : old('phone') }}" class="form-control"
                        name="phone" id="phone" placeholder="Enter phone">
                </div>
            </div>
        </div>

        {{-- step 3 --}}
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" class="form-label">Religion</label>
                    <select name="religion" id="religion" class="form-control">
                        @foreach (App\Custom\Helper::getReligion() as $key => $religion)
                            <option value="{{ $key }}"
                                {{ isset($user) ? App\Custom\Helper::Selected($key, $user->religion) : old('religion') }}>
                                {{ $religion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Date of birth</label>
                    <x-flatpickr name="dob" value="{{ isset($user) ? $user->dob : old('dob') }}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Role</label>
                    <select name="role_id" id="role_id" class="form-control">
                        @foreach (App\Custom\Helper::getRoles() as $key => $role)
                            <option value="{{ $role->name }}"
                                {{ isset($user) ? App\Custom\Helper::Selected($user->getRoleNames()->contains($role->name), $role->name) : old('role_id') }}>
                                {{ Str::ucfirst(Str::replace('-', ' ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" class="form-label">Status</label>
                    <div class="check-toggle">
                        <input type="checkbox" class="check" name="status" id="status"
                            {{ isset($user) ? App\Custom\Helper::getStatusValue($user->status) : old('status') }}>
                        <label for="status" class="checktoggle"></label>
                    </div>
                </div>
            </div>
        </div>

        {{-- step 4 --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-label">Address 1</label>
                    <textarea name="address_1" id="address_1" cols="20" rows="2" class="form-control">
                        {{ isset($user) ? $user->address_1 : old('address_1') }}
                    </textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-label">Address 2</label>
                    <textarea name="address_2" id="address_2" cols="20" rows="2" class="form-control">
                         {{ isset($user) ? $user->address_2 : old('address_1') }}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <button class="btn btn-success btn-flat btn-lg float-right">Submit</button>
        </div>
    </div>
</div>
