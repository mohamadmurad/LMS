<x-front-layout>

    @include('frontend.headSection',$subject)
    <div class="container">
        <div class="row">
            @auth()
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="sidebar ">
                        <!-- Review Widget -->
                        <div class="sidebar-widget review-widget">
                            <div class="widget-content">
                                <div class="content">
                                    <div class="price">Level</div>
                                    @if(\Illuminate\Support\Facades\Auth::check() && $subject->authEnrolledStudent())
                                        <div class="form-progress">
                                            <progress class="form-progress-bar" min="{{$thisLevel->point ?? 0}}"
                                                      max="{{$nextLevel? $nextLevel->point ?? 0 : $thisLevel->point ?? 0}}"
                                                      value="{{$totalPoints}}"
                                                      aria-labelledby="form-progress-completion"></progress>

                                            <div class="form-progress-indicator one active">
                                                <img src="   {{$thisLevel ? $thisLevel->level->getFirstMediaUrl('icon') : null }}">
                                            </div>
                                            <div class="form-progress-indicator two {{$nextLevel ? '':'active'}}">
                                                @if($nextLevel)
                                                    <img src="   {{$nextLevel->level->getFirstMediaUrl('icon')}}">
                                                @else
{{--                                                    <img src="   {{$thisLevel->level->getFirstMediaUrl('icon')}}">--}}
                                                @endif
                                            </div>

                                        </div>
                                    @endif

                                    <div>
{{--                                        @if($authLevel)--}}
{{--                                            <p>Level <b>{{$authLevel->name}}</b> from <b>{{$lastLevel->name}}</b></p>--}}

{{--                                        @endif--}}


                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- End Review Widget -->
                    </div>
                </div>
            @endauth
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="sec-title">
                    <h4>{{$subject->name}}</h4>
                </div>

                <div class="video-box">
                    <figure class="video-image">
                        <img src="{{$subject->getFirstMediaUrl('cover')}}" alt="">
                    </figure>
                    <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image overlay-box"><span
                            class="flaticon-media-play-symbol"><i class="ripple"></i></span></a>
                </div>

                <div class="video-info-boxed">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h6>{{$subject->name}}</h6>
                            <div class="author">
                                <div class="user-image"><img src="{{asset('images/avataruser.png')}}" alt="">
                                </div>{{$subject->creator->name}}
                            </div>

                        </div>
                        <div class="pull-right">
                            <ul class="social-box">
                                <li class="share">Share now on</li>
                                <li class="facebook"><a href="#" class="fab fa-facebook-f"></a></li>
                                <li class="google"><a href="#" class="fab fa-google"></a></li>
                                <li class="twitter"><a href="#" class="fab fa-twitter"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="course-info-tabs">
                    <!-- Course Tabs-->
                    <div class="course-tabs tabs-box">
                        <nav>
                            <div class="nav nav-tabs tab-btns tab-buttons clearfix" id="nav-tab" role="tablist">
                                <li class="tab-btn active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#prod-class" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Subject Details
                                </li>
                                <li class=" tab-btn" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#prod-curriculum" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">Curriculum
                                </li>
                                <li class=" tab-btn" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#prod-review" type="button" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Reviews
                                </li>
                                @auth()
                                    <li class=" tab-btn" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#prod-badges" type="button" role="tab"
                                        aria-controls="nav-contact"
                                        aria-selected="false">Badges
                                    </li>
                                @endauth
                            </div>
                        </nav>


                        <!-- Tabs Container -->
                        <div class="tab-content" id="nav-tabContent">

                            <!-- Tab / Active Tab -->
                            <div class="tab-pane fade show active" id="prod-class" role="tabpanel"
                                 aria-labelledby="nav-prod-tab">
                                <div class="content">
                                    <!-- Class Detail Content -->
                                    <div class="class-detail-content">
                                        {!! $subject->description !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Tab -->
                            <div class="tab-pane fade" id="prod-curriculum" role="tabpanel"
                                 aria-labelledby="nav-curriculum-tab">
                                <div class="content">

                                    <div class="accordion accordion-box" id="accordionExample">
                                        @foreach($subject->modules as $index => $module)
                                            <div class="accordion-item block">
                                                <h2 class="accordion-header acc-btn" id="heading{{$index}}">
                                                    <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{$index}}"
                                                            aria-expanded="true" aria-controls="collapse{{$index}}">
                                                        {{$index+1}}  {{$module->name}}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{$index}}"
                                                     class="accordion-collapse collapse {{$index == 0 ? 'show':''}}"
                                                     aria-labelledby="heading{{$index}}"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @foreach($module->ReadingObjectives as $objective)
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="#"
                                                                           class="lightbox-image play-icon"><span
                                                                                class="fa fa-book"></span>{{$objective->name}}
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                            </div>

                            <livewire:subject-rate :subject="$subject"/>

                            <!-- Tab / Active Tab -->
                            <div class="tab-pane fade" id="prod-badges" role="tabpanel"
                                 aria-labelledby="nav-prod-tab">
                                <div class="content">
                                    <!-- Class Detail Content -->
                                    <div class="class-detail-content">
                                        <div class="badges">
                                            @foreach($awardBadges as $badge)
                                                <div class="badge-item">
                                                    @if($badge->badge->hasMedia('icon'))
                                                        <img src="{{$badge->badge->getFirstMediaUrl('icon')}}"
                                                             alt="{{$badge->badge->name}}"
                                                             title="{{$badge->badge->name}}">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="sidebar ">

                    <!-- Review Widget -->
                    <div class="sidebar-widget review-widget">
                        <div class="widget-content">
                            <div class="content">


                                <div class="time-left">{{$totalStudent}} Student in this Subject
                                </div>
                                <div class="buttons-box">

                                    @if(\Illuminate\Support\Facades\Auth::check() && $subject->authEnrolledStudent())

                                        <a href="{{route('student.subject.learn',$subject)}}"
                                           class="theme-btn btn-style-two"><span class="txt">Go to
                                            Course</span></a>

                                    @else
                                        <div class="">

                                            <form action="{{route('student.subject.enroll',$subject)}}" method="post">
                                                @csrf

                                                <button
                                                    class="theme-btn btn-style-two"><span class="txt">Enroll</span>
                                                </button>
                                            </form>
                                        </div>
                                    @endif


                                    <a href="{{route('student.leaderboard',$subject)}}" class="theme-btn btn-style-one"><span
                                            class="txt">Leaderboard</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Review Widget -->

                    @auth()
                        <!-- Review Widget -->
                        <div class="sidebar-widget review-widget">
                            <div class="widget-content">
                                <div class="content">
                                    <div class="price">
                                        Point Earned
                                        <span>{{$totalPoints}}</span>
                                    </div>

                                    <div class="buttons-box">

                                        <a href="{{route('student.subject.points',$subject)}}"
                                           class="theme-btn btn-style-one"><span class="txt">Your Points</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Review Widget -->
                    @endauth

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="subject">

            <div class="subject-head p-2 ">
                <div class="d-flex justify-content-between">


                </div>


            </div>


        </div>
    </div>


    @section('scripts')
        <script>
            $('.seeallbtn').on('click', function (e) {
                let id = $(this).data('id');
                if ($('#allContent_' + id).is(":visible")) {
                    $(this).html('see All');
                    $('#allContent_' + id).hide();
                } else {
                    $(this).html('see less');
                    $('#allContent_' + id).show();
                }


            })
        </script>

    @endsection
</x-front-layout>
