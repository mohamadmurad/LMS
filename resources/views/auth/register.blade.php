<x-guest-layout>


    <div class="card z-index-0">
        <div class="card-header text-center pt-4">
            <h5>Register with</h5>
        </div>

        <div class="card-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            <form role="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div id="status-group">

                    <div class="radio">
                        <label class=""><input class="register-profile" data-order="1" value="0" type="radio"
                                               id="qf_0feebc" name="status" checked="checked">
                            <p class="caption">Student</p></label>
                    </div>
                    <div class="radio">
                        <label class=""><input class="register-profile" data-order="2" value="1" type="radio"
                                               id="qf_83c64e" name="status">
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
                    <input type="text" data-date="dirthdate" class="form-control" placeholder="dirthdate" value="{{old('birthdate')}}"
                           aria-label="birthdate"
                           name="birthdate" required>

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


    {{--        <form method="POST" action="{{ route('register') }}">--}}
    {{--            @csrf--}}

    {{--            <!-- Name -->--}}
    {{--            <div>--}}
    {{--                <x-label for="name" :value="__('Name')" />--}}

    {{--                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />--}}
    {{--            </div>--}}

    {{--            <!-- Email Address -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="email" :value="__('Email')" />--}}

    {{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
    {{--            </div>--}}

    {{--            <!-- Password -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="password" :value="__('Password')" />--}}

    {{--                <x-input id="password" class="block mt-1 w-full"--}}
    {{--                                type="password"--}}
    {{--                                name="password"--}}
    {{--                                required autocomplete="new-password" />--}}
    {{--            </div>--}}

    {{--            <!-- Confirm Password -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="password_confirmation" :value="__('Confirm Password')" />--}}

    {{--                <x-input id="password_confirmation" class="block mt-1 w-full"--}}
    {{--                                type="password"--}}
    {{--                                name="password_confirmation" required />--}}
    {{--            </div>--}}

    {{--            <div class="flex items-center justify-end mt-4">--}}
    {{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
    {{--                    {{ __('Already registered?') }}--}}
    {{--                </a>--}}

    {{--                <x-button class="ml-4">--}}
    {{--                    {{ __('Register') }}--}}
    {{--                </x-button>--}}
    {{--            </div>--}}
    {{--        </form>--}}

</x-guest-layout>
