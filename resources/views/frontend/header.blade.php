<!-- ? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{asset('assets/front/img/logo/loder.png')}}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{route('home')}}"><img src="{{asset('assets/front/img/logo/logo.png')}}"
                                                                 alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class="active"><a href="{{route('home')}}">Home</a></li>
                                            <li><a href="{{route('subjects')}}">Subjects</a></li>
                                            {{--                                            <li><a href="about.html">About</a></li>--}}
                                            {{--                                            <li><a href="#">Blog</a>--}}
                                            {{--                                                <ul class="submenu">--}}
                                            {{--                                                    <li><a href="blog.html">Blog</a></li>--}}
                                            {{--                                                    <li><a href="blog_details.html">Blog Details</a></li>--}}
                                            {{--                                                    <li><a href="elements.html">Element</a></li>--}}
                                            {{--                                                </ul>--}}
                                            {{--                                            </li>--}}
                                            {{--                                            <li><a href="contact.html">Contact</a></li>--}}
                                            <!-- Button -->
                                            @auth

                                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
                                                    <form method="POST"
                                                          action="{{ route('logout') }}" @class('d-inline')>
                                                        @csrf

                                                        <span type="submit" class="btn hero-btn"
                                                              :href="route('logout')"
                                                              onclick="event.preventDefault();
                                                this.closest('form').submit();">
                              {{ __('Log Out') }}
                            </span>
                                                        <a href="{{route('profile')}}" > Profile </a>
                                                    </form>
                                                @else
                                                    <li class="button-header"><a
                                                            href="{{ route('backend.dashboard.index') }}"
                                                            class="btn hero-btn">Dashboard</a></li>
                                                @endif
                                            @else

                                                <li class="button-header"><a href="{{ route('login') }}"
                                                                             class="btn btn3">Log in</a></li>
                                                @if (Route::has('register'))
                                                    <li class="button-header margin-left "><a
                                                            href="{{ route('register') }}" class="btn">Join</a></li>

                                                @endif
                                            @endauth

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
