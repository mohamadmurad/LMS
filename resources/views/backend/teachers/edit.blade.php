<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Teacher</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.teachers.update',$teacher)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First Name</label>
                                    <input class="form-control" type="text" name="first_name"
                                           value="{{$teacher->first_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name"
                                           value="{{$teacher->last_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">email</label>
                                    <input class="form-control" type="email" name="email" value="{{$teacher->email}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">

                                    <div class="card card-profile mw-50">
                                        <img class="Image edit-image" src="{{$teacher->getFirstMediaUrl('certificate')}}"
                                             alt="cert_imgage"/>
                                    </div>


                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Certificate Image</label>
                                    <input class="form-control" type="file" name="cert_img" accept="image/*"
                                    >
                                    <p @class('text-sm')>Dont upload new one if you don't wont to update it</p>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">password</label>
                                    <input class="form-control" type="password" name="password"
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birth Date</label>
                                    <input type="text" data-date="dirthdate" class="form-control"
                                           placeholder="dirthdate" value="{{$teacher->birthdate}}"
                                           aria-label="birthdate"
                                           name="birthdate" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >Update</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            birthdate.daterangepicker({
                startDate: "{{\Illuminate\Support\Carbon::make($teacher->birthDate) ? \Illuminate\Support\Carbon::make($teacher->birthDate)->format('d/m/y') : '01/01/1999' }}",
                //  autoUpdateInput: false,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
        </script>
    @endsection
</x-app-layout>


