<x-guest-layout>
    <div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder"> Dear {{ Auth::user()->name }}</h4>
                <h4 class="font-weight-bolder">  Your Account Not Verified</h4>
                <p class="mb-0">Please Wait Admin to verify your account</p>


                <form method="POST" action="{{ route('logout') }}" >
                    @csrf

                    <span type="submit" class=" btn btn-success d-sm-inline d-none" :href="route('logout')"
                          onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </span>
                </form>
            </div>



        </div>
    </div>





</x-guest-layout>
