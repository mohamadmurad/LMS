<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
           target="_blank">
            {{--            <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">--}}
            <span class="ms-1 font-weight-bold">LMS {{\Illuminate\Support\Facades\Auth::user()->roles[0]->name}}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Admin'))
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.dashboard.index')? 'active': ''}}" href="{{route('backend.dashboard.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-dashboard text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.admins.*')? 'active': ''}}"
                       href="{{route('backend.admins.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-lock-open text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Admins</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.teachers.index')? 'active': ''}}"
                       href="{{route('backend.teachers.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user-check text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">teachers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.students.index')? 'active': ''}}"
                       href="{{route('backend.students.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">students</span>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.rules.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.rules.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-ruler text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">Rules</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.categories.index')? 'active': ''}}"
                       href="{{route('backend.categories.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-square text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.levels.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.levels.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">levels</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.badges.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.badges.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">Badges</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.badgeRule.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.badgeRule.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">badge Rule</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.subjects.*')? 'active': ''}}"
                       href="{{route('backend.subjects.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-book-bookmark text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Subjects</span>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.studentBehavior.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.studentBehavior.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">Student Behaviors</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.behaviorPoints.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.behaviorPoints.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">Behavior Points</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.behaviorPointsRules.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.behaviorPointsRules.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">Behavior Points Rules</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('teacher'))
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('backend.subjects.index')? 'active': ''}}"
                       href="{{route('backend.subjects.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-square text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Subjects</span>
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('backend.students.index')? 'active': ''}}"
                           href="{{route('backend.students.index')}}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-users text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">students</span>
                        </a>
                    </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.badgeRule.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.badgeRule.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">badge Rule</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('backend.studentBehavior.index')? 'active': ''}}"--}}
{{--                       href="{{route('backend.studentBehavior.index')}}">--}}
{{--                        <div--}}
{{--                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                            <i class="fa fa-square text-primary text-sm opacity-10"></i>--}}
{{--                        </div>--}}
{{--                        <span class="nav-link-text ms-1">Student Behaviors</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif


        </ul>
    </div>

</aside>
