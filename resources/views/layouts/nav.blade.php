<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
     data-scroll="false">
    <div class="container-fluid py-1 px-3">
        @yield('breadcrumb')

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
            <ul class="navbar-nav  justify-content-end">

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>

                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user cursor-pointer me-2"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{route('profile')}}">

                                <i class="fa fa-user me-2"></i>Profile

                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">

                                <form method="POST" action="{{ route('logout') }}" @class('d-inline')>
                                    @csrf

                                    <span type="submit" class="d-sm-inline d-none" :href="route('logout')"
                                          onclick="event.preventDefault();
                                                this.closest('form').submit();">
                               <i class="fa fa-sign-out me-2"></i> {{ __('Log Out') }}
                            </span>
                                </form>

                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
