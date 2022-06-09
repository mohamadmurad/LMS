<x-guest-layout>


    <div class="card z-index-0">
        <div class="card-header text-center pt-4">
            <h5>Register with</h5>
        </div>

        <div class="card-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            <form role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div id="status-group">

                    <div class="radio">
                        <label class=""><input class="register-profile" data-order="1" value="0" type="radio"
                                               id="qf_0feebc" name="status" {{old('status') == '0' || old('status') == null ? 'checked' :''}}>
                            <p class="caption">Student</p></label>
                    </div>
                    <div class="radio">
                        <label class=""><input class="register-profile" data-order="2" value="1" type="radio"
                                               id="qf_83c64e" name="status" {{old('status') == '1' ? 'checked' :''}}>
                            <p class="caption">Teacher</p></label>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="First Name" name="first_name"
                           aria-label="FirstName" value="{{old('first_name')}}" required autofocus>

                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Last Name" aria-label="LastName"
                           name="last_name" value="{{old('last_name')}}" required>

                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email"
                           value="{{old('email')}}" required>

                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                           name="password" required autocomplete="new-password">

                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                           name="password_confirmation" required>

                </div>

                <div class="mb-3">
                    <input type="text" data-date="dirthdate" class="form-control" placeholder="dirthdate"
                           value="{{old('birthdate')}}"
                           aria-label="birthdate"
                           name="birthdate" required>

                </div>

                <div class="form-group" id="cert_img" style="display: none">
                    <label for="example-text-input" class="form-control-label">Certificate Image</label>
                    <input class="form-control" type="file" name="cert_img" accept="image/*">

                </div>
                <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{route('login')}}"
                                                                         class="text-dark font-weight-bolder">Sign
                        in</a></p>
            </form>
        </div>
    </div>


    @section('scripts')

        <script>
            $('input[type=radio][name="status"]').change(function () {
                let val = $(this).val();
                if (val == 1) {
                    $('#cert_img').show();
                    $('#cert_img input').attr('required', true);
                } else {
                    $('#cert_img').hide();
                    $('#cert_img input').attr('required', false);
                }

            })

            //$('#cert_img')
        </script>
    @endsection
</x-guest-layout>
