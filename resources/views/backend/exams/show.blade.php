<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.index',$subject)}}">{{$subject->name}}</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Exams</li>

            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Exams</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">

            <div class="card-body px-0 pt-0 pb-2">
                <h1>Exam : {{$exam->name}}</h1>
                <h3>Level :
                    @if($exam->level == 0)
                        Easy
                    @elseif($exam->level == 1)
                        Medium
                    @else
                        Hard
                    @endif

                </h3>
                <h5>Questions</h5>
                <div class="table-responsive p-0">

                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Question
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Objective
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exam->questions as $question)
                            <tr>
                                <td>{{$question->question}}</td>
                                <td>
                                    @if($question->level == 0)
                                        Basic
                                    @elseif($question->level == 1)
                                        Advanced
                                    @else
                                        Hard
                                    @endif


                                </td>
                                <td>{{$question->objective->module->name}} --> {{$question->objective->name}}</td>
                                <td>
                                    @foreach($question->options as $op)
                                        <span
                                            class="badge {{$op->correct? 'bg-success':"bg-info"}}">{{$op->option}}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
