<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Students</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Students</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-header">
                <span class="font-weight-bold text-lg">Student {{$student->name}} Info</span>
                <span class="d-block font-weight-bold text-lg">Subject {{$subject->name}}</span>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-header">
                <span class="font-weight-bold text-lg">Points</span>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Point
                                Reason
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Point Type
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Count</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authPoints as $point)
                            <tr>
                                <td>{{$point->point->reason->name}}</td>
                                <td>{{$point->point->behavior[0]->human_name}}</td>
                                <td>{{$point->point->count}}</td>
                                <td>{{$point->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-header">
                <span class="font-weight-bold text-lg">Exams</span>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Exam</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mark</th>
{{--                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Count</th>--}}
{{--                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>--}}
                        </tr>
                        </thead>
                        <tbody>

{{--                        @foreach($student->exam_submit as $exam)--}}
{{--                            <tr>--}}
{{--                                <td><a href="{{route('teacher.subjects.student.exam.info',[--}}
{{--                                            'subject'=> $subject,--}}
{{--                                            'student'=>$student,--}}
{{--                                            'exam' => $exam,--}}
{{--                                        ])}}">{{$exam->name}}</a></td>--}}
{{--                                <td>{{$exam->pivot->final_mark}}</td>--}}

{{--                                --}}{{--                                    <td>{{$point->point->rule->human_name}}</td>--}}
{{--                                --}}{{--                                    <td>{{$point->count}}</td>--}}
{{--                                --}}{{--                                    <td>{{$point->created_at}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
