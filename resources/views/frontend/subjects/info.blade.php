<x-front-layout>

    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">{{$subject->name}}</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('subjects')}}">Subjects</a></li>
                                        <li class="breadcrumb-item"><a href="#">{{$subject->name}}</a></li>
                                    </ol>
                                </nav>
                                <!-- breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-5">
        <div class="subject">

            <div class="subject-head p-2 ">
                <div class="d-flex justify-content-between">
                    <div class="">

                        <div class="">
                            <div class="d-flex gap-3 mb-3 align-items-center">
                                <span>{{$totalStudent}} Student in this Subject</span>.
                                <livewire:subject-rate :subject="$subject"/>


                            </div>
                        </div>

                    </div>
                    <div class="teacher">
                        <span>By {{$subject->creator->name}}</span>

                    </div>
                    <div class="badges">
                        @foreach($awardBadges as $badge)
                            <div class="badge-item">
                                @if($badge->badge->hasMedia('icon'))
                                        <img src="{{$badge->badge->getFirstMediaUrl('icon')}}">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div>
                        @if($authLevel)
                            <p>Level <b>{{$authLevel->name}}</b> from <b>{{$lastLevel->name}}</b></p>
                            <p>Total Earned Point <a
                                    href="{{route('student.subject.points',$subject)}}"><span>{{$totalPoints}}</span></a>
                            </p>
                        @endif


                    </div>
                </div>


                @if(\Illuminate\Support\Facades\Auth::check() && $subject->authEnrolledStudent())
                    <a class="btn " href="{{route('student.subject.learn',$subject)}}">Go to
                        Course</a>
                @else
                    <div class="">
                        <form action="{{route('student.subject.enroll',$subject)}}" method="post">
                            @csrf
                            <button class="btn " href="">Enroll</button>
                        </form>
                    </div>
                @endif

            </div>

            <div class="subject-body py-5">
                <h2>About this Subject </h2>
                <div class="subject-description">
                    {!! $subject->description !!}
                </div>
            </div>

            <div class="subject-footer py-3">

                <div class="Syllabus">
                    <div class="text-center">
                        <h2>Syllabus - What you will learn from this course</h2>
                    </div>
                    <div class="modules">

                        @foreach($subject->modules as $index => $module)
                            <div class="d-flex SyllabusWeek">
                                <div class="moduleWeeks py-4">
                                    <div class="week">Module</div>
                                    <span>{{$index+1}}</span>
                                </div>
                                <div class="SyllabusModule py-4">
                                    <h2>{{$module->name}}</h2>
                                    <div class="module-desc my-3">
                                        {!! $module->desc !!}
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="objective-icon me-4"><i class="fa fa-book"></i></div>
                                        <div class="countingObjective">
                                            @if($module->VideoObjectives->count())
                                                <span>{{$module->VideoObjectives->count()}} videos</span>
                                            @endif
                                            @if($module->ReadingObjectives->count())
                                                <span>{{$module->ReadingObjectives->count()}} reading</span>
                                            @endif


                                        </div>
                                        <div class="">
                                            <button class="seeallbtn" data-id="{{$index}}">see All</button>
                                        </div>
                                    </div>

                                    <div class="SyllabusModuleDetails" id="allContent_{{$index}}" style="display: none">
                                        @if($module->VideoObjectives->count() > 0)
                                            <div class="objectiveItem">
                                                <div class="d-flex">
                                                    <div class=""><i class="fa fa-book"></i></div>
                                                    <span>{{$module->VideoObjectives->count()}} Videos</span>
                                                </div>
                                                @foreach($module->VideoObjectives as $objective)
                                                    <div class="">{{$objective->name}}</div>


                                                @endforeach
                                            </div>
                                        @endif
                                        @if($module->ReadingObjectives->count() > 0)
                                            <div class="objectiveItem">
                                                <div class="d-flex">
                                                    <div class=""><i class="fa fa-book me-3"></i></div>
                                                    <span>{{$module->ReadingObjectives->count()}} reading</span>
                                                </div>
                                                @foreach($module->ReadingObjectives as $objective)
                                                    <div class="my-2">{{$objective->name}}</div>


                                                @endforeach
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>

            <livewire:subject-reviews :subject="$subject"/>

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
