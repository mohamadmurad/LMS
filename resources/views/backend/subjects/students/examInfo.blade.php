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
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Question</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student Answer</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($submitExam->answers as $answer)

                            <tr>
                                <td>{{$answer->question}}</td>
                                <td>{{$answer->pivot->option->option }}</td>
                                <td><span class="badge {{$answer->pivot->option->correct ? 'bg-success':'bg-danger'}} ">{{$answer->pivot->option->correct ? 'Yes':'No'}}</span></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
