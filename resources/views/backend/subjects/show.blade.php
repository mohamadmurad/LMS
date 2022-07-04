<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Subjects</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Subjects</h6>
        </nav>
    @endsection
    <div class="row mb-2">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Subject {{$subject->name}} </h6>

                </div>
                <div class="card-body pt-0 pb-2">

                    <div class="row">

                    </div>
                    <div class="row course-tools">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.subjects.student',$subject)}}">
                                        <img src="{{asset('assets/img/members.png')}}" alt="Students" title="Students"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.subjects.student',$subject)}}">Students</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.assignments.index',$subject)}}">
                                        <img src="{{asset('assets/img/works.png')}}" alt="Assignments"
                                             title="gradebook"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.assignments.index',$subject)}}">Assignments</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.questions.index',$subject)}}">
                                        <img src="{{asset('assets/img/gradebook.png')}}" alt="Question Bank"
                                             title="gradebook"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.assignments.index',$subject)}}">Question Bank</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.exams.index',$subject)}}">
                                        <img src="{{asset('assets/img/quiz.png')}}" alt="Exam" title="Exam"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.exams.index',$subject)}}">Exam</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.placements.index',$subject)}}">
                                        <img src="{{asset('assets/img/quiz.png')}}" alt="Placements" title="Placements"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.placements.index',$subject)}}">Placements</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.modules.index',$subject)}}">
                                        <img src="{{asset('assets/img/course_progress.png')}}" alt="Modules"
                                             title="Module"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.modules.index',$subject)}}">Modules</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.subject.level.show',$subject)}}">
                                        <img src="{{asset('assets/img/course_progress.png')}}" alt="Levels"
                                             title="Levels"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.subject.level.show',$subject)}}">Levels</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="course-tool">
                                <div class="big-icon">
                                    <a href="{{route('backend.subject.leaderboard.show',$subject)}}">
                                        <img src="{{asset('assets/img/course_progress.png')}}" alt="Levels"
                                             title="Levels"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{route('backend.subject.leaderboard.show',$subject)}}">Leaderboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
