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
                    <a href="javascript:;" class="nav-link text-white p-0" id="notificationDropdown"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell cursor-pointer" aria-hidden="true"></i>
                        <span style="position: absolute;width: 20px;height: 20px;
                            @if($unreadNotifications!=0)
                            display: flex;
                            @else
                            display: none;
                            @endif
                            left: -18px;    top: 0px;    border-radius: 50%;    background: #c00;    color: #fff;    font-size: 14px;    justify-content: center;    align-items: center;" id="dropdown-notifications-icon">{{$unreadNotifications}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 notifications-container" aria-labelledby="notificationDropdown">
                        @foreach($notifications as $notification)
                            @php
                                $bg = $notification['read_at']==null ?"#f1f1f1":"#ffffff";
                            @endphp
                            <li class="mb-2 dropdown-item border-radius-md">
{{--                                <a class="dropdown-item border-radius-md" href="javascript:;" style="background:{{$bg}} ">--}}
                                    <div class="d-flex py-1">
{{--                                        <div class="my-auto">--}}
{{--                                            <img--}}
{{--                                                --}}{{--                                            src="./assets/img/team-2.jpg"--}}
{{--                                                @if(isset($notification['image']) && $notification['image']!=null)--}}
{{--                                                    src="{{$notification['image']}}"--}}
{{--                                                @else--}}
{{--                                                    src="{{ env('DEFAULT_IMAGE_NOTIFICATION') }}"--}}
{{--                                                @endif--}}
{{--                                                class="avatar avatar-sm  me-3 ">--}}
{{--                                        </div>--}}
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                @if($notification['read_at']==null)
                                                <span
                                                    class="font-weight-bold">New Notification</span>
                                                @endif
                                                    {!!$notification->data['message']!!}
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                                {{\Illuminate\Support\Carbon::parse($notification['created_at'])->diffForHumans()}}
                                            </p>
                                        </div>
                                    </div>
{{--                                </a>--}}
                            </li>
                        @endforeach
                        @if(count($notifications)==0)
                            <li class="mb-2">

                                <div class="d-flex py-1">

                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            No Notification
                                        </h6>

                                    </div>
                                </div>

                            </li>

                        @endif
                    </ul>
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
