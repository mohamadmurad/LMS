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
        <div class="welcome-head d-flex justify-content-between">
            <div>
                <h1>{{$subject->name}}</h1>
                <p>by {{$subject->creator->name}}</p>
            </div>


        </div>
        @if(!$subject->is_completed)
            <a class="btn btn-primary"
               href="{{route('student.subject.learnObjective',['subject'=>$subject,'objective'=>$lastSeenObjective])}}">continue</a>
        @endif

        @if($subject->placement)
            <a class="btn btn-info"
               href="{{route('student.subject.placement.show',['subject'=>$subject,'placement'=>$subject->placement])}}">Placement</a>

        @endif


        <div class="welcome-progress">
            <div class="courseProgressBar">
                <div class="progress-section">
                    <div class="">
                        <div class="horizontal-box">
                            <div class="start-week-section week-section">
                                <div class="rc-WeekStatusIndicator vertical-box prev-week-completed week-completed">
                                    <div class="completed"></div>
                                    <div class="label">Start</div>
                                </div>

                            </div>
                            <?php $prev_complete = false; ?>
                            @foreach($subject->modules as $index=>$modules)
                                <div class="week-section">

                                    <div
                                        class="rc-WeekAssignmentIcons {{$prev_complete || $index ==0 ? 'prev-week-completed':''}} {{$modules->is_completed ?'week-completed' : ''}}">

                                        @if($modules->is_completed )
                                            <?php $prev_complete = true; ?>
                                        @else
                                            <?php $prev_complete = false; ?>
                                        @endif
                                        <div class="vertical-box">
                                            <div class="hoverable-overlay-trigger">
                                                <div class="icon-wrapper" role="tooltip" tabindex="0"
                                                     aria-describedby="tooltip-description-7cVLr">
                                                    @if($modules->is_completed)
                                                        <svg fill="#1F8354" class="_ufjrdd" aria-hidden="true"
                                                             focusable="false" viewBox="0 0 48 48" role="img"
                                                             aria-labelledby="Completedb2e43b61-2807-4cc5-96f3-3ffd55573f3b Completedb2e43b61-2807-4cc5-96f3-3ffd55573f3bDesc"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             style="fill: rgb(54, 59, 66); height: 24px; width: 24px;">
                                                            <path
                                                                d="M1 24C1 11.318375 11.318375 1 24 1s23 10.318375 23 23-10.318375 23-23 23S1 36.681625 1 24zm20.980957 4.2558594l-7.7418213-7.0596924L12 23.5592041l9.980957 9.6016846 15.2832032-16.4852295L34.9130859 14 21.980957 28.2558594z"
                                                                fill="#1F8354" role="presentation"></path>
                                                        </svg>
                                                    @else
                                                        <svg aria-hidden="false" class="_ufjrdd" viewBox="0 0 48 48"
                                                             role="img"
                                                             aria-labelledby="Quiz60543a8f-f414-4481-cb7b-f8d886c984d5 Quiz60543a8f-f414-4481-cb7b-f8d886c984d5Desc"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             style="fill: rgb(54, 59, 66); height: 24px; width: 24px;">
                                                            <title id="Quiz60543a8f-f414-4481-cb7b-f8d886c984d5">
                                                                Quiz</title>
                                                            <path
                                                                d="M24 47C11.3 47 1 36.7 1 24S11.3 1 24 1s23 10.3 23 23-10.3 23-23 23zm0-1.84c11.7 0 21.16-9.47 21.16-21.16C45.16 12.3 35.7 2.84 24 2.84 12.3 2.84 2.84 12.3 2.84 24c0 11.7 9.47 21.16 21.16 21.16zM21 17h10v2H21v-2zm0 6h10v2H21v-2zm0 6h10v2H21v-2zm-3-10c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-5-21h22v28H13V10zm2 2v24h18V12H15z"
                                                                role="presentation"></path>
                                                        </svg>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="label horizontal-box align-items-vertical-center">
                                                <span>Module {{$modules->name}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="end-week-section week-section ">
                                <div
                                    class="rc-WeekStatusIndicator vertical-box {{$prev_complete ? 'prev-week-completed':''}}">
                                    <div class="ontrack"></div>
                                    <div class="label"><span>End</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="welcome-modules">
            <div class="accordion accordion-flush" id="accordionExample">
                @foreach($subject->modules as $index=>$module)
                    <div class="accordion-item card my-3 moduleItem" data-linkid="{{$module->id}}">
                        <h2 class="card-header p-0" id="heading_{{$module->id}}">
                            <button @class(['accordion-button text-bold','collapsed'=>$index!=0])  class type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse_{{$module->id}}" aria-expanded="true"
                                    aria-controls="collapse_{{$module->id}}">
                                @if($modules->is_completed)
                                    <svg fill="#1F8354" class="_ufjrdd" aria-hidden="true" focusable="false"
                                         viewBox="0 0 48 48" role="img"
                                         aria-labelledby="Completedb2e43b61-2807-4cc5-96f3-3ffd55573f3b Completedb2e43b61-2807-4cc5-96f3-3ffd55573f3bDesc"
                                         xmlns="http://www.w3.org/2000/svg"
                                         style="fill: rgb(54, 59, 66); height: 24px; width: 24px;">
                                        <path
                                            d="M1 24C1 11.318375 11.318375 1 24 1s23 10.318375 23 23-10.318375 23-23 23S1 36.681625 1 24zm20.980957 4.2558594l-7.7418213-7.0596924L12 23.5592041l9.980957 9.6016846 15.2832032-16.4852295L34.9130859 14 21.980957 28.2558594z"
                                            fill="#1F8354" role="presentation"></path>
                                    </svg>

                                @endif
                                {{$module->name}}
                            </button>
                        </h2>
                        <div id="collapse_{{$module->id}}"
                             @class(['accordion-collapse collapse','show'=>$index==0]) class="accordion-collapse collapse "
                             aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body card-body ">

                                <div class="text-center">{!! nl2br($module->desc) !!}</div>


                                <h5>Objectives</h5>
                                <ul class="list-group">
                                    @foreach($module->objectives as $objective)
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-white">
                                            <a class=""
                                               href="{{route('student.subject.learnObjective',['subject'=>$subject,'objective' => $objective])}}">
                                                <i class="fa  {{$objective->type ? 'fa-video' : 'fa-book'}} me-2"></i>{{$objective->name}}
                                                <br>
                                                <i class="fa fa-gift me-2"></i>{{$objective->points()->first()->count}}
                                                points

                                            </a>

                                        </li>

                                    @endforeach
                                </ul>
                                <ul class="list-group">
                                    @foreach($module->assignments as $assignment)
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-white">
                                            <a class=""
                                               href="{{route('student.subject.assignment',['subject'=>$subject,'assignment' => $assignment])}}">
                                                <i class="fa  fa-check me-2"></i><b>Assignment:</b> {{$assignment->name}}
                                            </a>

                                        </li>

                                    @endforeach
                                </ul>

                                <ul class="list-group">
                                    @foreach($module->exams as $exam)
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-white">
                                            <a class=""
                                               href="{{route('student.subject.exam.show',['subject'=>$subject,'exam' => $exam])}}">
                                                <i class="fa  fa-pencil-alt me-2"></i><b>Exam:</b> {{$exam->name}}
                                            </a>

                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer d-flex justify-content-center align-items-center gap-2">


                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>


    </div>


</x-front-layout>
