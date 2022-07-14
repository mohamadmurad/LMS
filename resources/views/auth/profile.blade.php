<x-app-layout>


    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
{{--                        <img src="../assets/img/team-1.jpg" alt="profile_image"--}}
{{--                             class="w-100 border-radius-lg shadow-sm">--}}
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"   class="w-100 border-radius-lg shadow-sm"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
    <circle style="fill:#D1E5F5;" cx="256" cy="120.889" r="120.889"/>
    <path style="fill:#D1E5F5;" d="M412.444,512c31.418,0,56.889-25.471,56.889-56.889c0-117.82-95.514-213.333-213.333-213.333
		S42.667,337.291,42.667,455.111c0,31.418,25.471,56.889,56.889,56.889H412.444z"/>
</g>
                            <g>
                                <polygon style="fill:#B4D8F1;"
                                         points="255.999,241.778 255.999,241.778 256,241.778 	"/>
                                <path style="fill:#B4D8F1;" d="M376.889,120.889C376.889,54.124,322.765,0,256,0h-0.001v241.778H256
		C322.765,241.778,376.889,187.654,376.889,120.889z"/>
                                <path style="fill:#B4D8F1;" d="M256,241.778L256,241.778L255.999,512h156.446c31.418,0,56.889-25.471,56.889-56.889
		C469.333,337.291,373.82,241.778,256,241.778z"/>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
</svg>

                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$user->name}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$user->roles[0]->name}}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form method="post" action="{{route('profile.update')}}">
                        @csrf
                        @method('put')
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First Name</label>
                                        <input class="form-control" type="text" value="{{$user->first_name}}"
                                               name="first_name" onfocus="focused(this)" onfocusout="defocused(this)"
                                               required>
                                        @error('first_name') <span class="text-danger d-block">{{ $errors->first('first_name') }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last Name</label>
                                        <input class="form-control" type="text" value="{{$user->last_name}}"
                                               name="last_name" onfocus="focused(this)" onfocusout="defocused(this)"
                                               required>
                                        @error('last_name') <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email"
                                               value="{{$user->email}}" name="email" onfocus="focused(this)"
                                               onfocusout="defocused(this)" required>
                                        @error('email') <span class="text-danger d-block">{{ $errors->first('email') }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">BirthDate</label>
                                        <input class="form-control" type="text" data-date="dirthdate"
                                               name="birthdate" onfocus="focused(this)"
                                               onfocusout="defocused(this)" required>
                                        @error('birthdate') <span class="text-danger d-block">{{ $errors->first('birthdate') }}</span>@enderror
                                    </div>
                                </div>


                                <p>Password</p>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">New Password</label>
                                        <input class="form-control" type="password"
                                              name="new_password" onfocus="focused(this)"
                                               onfocusout="defocused(this)" >
                                        @error('new_password') <span class="text-danger d-block">{{ $errors->first('new_password') }}</span>@enderror
                                        <small>Keep it empty if not want to change password</small>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @section('scripts')
        <script>
            @if($user->birthDate != null)
            birthdate.daterangepicker({
                startDate: "{{\Illuminate\Support\Carbon::make($user->birthDate)->format('m/d/Y')}}",
                //  autoUpdateInput: false,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
            @else
            birthdate.daterangepicker({
                startDate: "{{\Illuminate\Support\Carbon::now()->format('m/d/Y')}}",
                //  autoUpdateInput: false,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
            @endif

        </script>
    @endsection
</x-app-layout>
