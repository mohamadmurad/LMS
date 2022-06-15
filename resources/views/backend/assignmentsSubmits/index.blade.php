<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.index',$subject)}}">{{$subject->name}}</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Assignment</li>

            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Assignments</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Assignments Submits</h6>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assignment
                                Name
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student
                                Name
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Module</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mark</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($submits as $submit)
                            <tr>
                                <td>{{$submit->assignment->name}}</td>
                                <td>{{$submit->student->name}}</td>
                                <td>{{$submit->assignment->module->name}}</td>
                                <td>
                                    @if($submit->status)
                                        <span class="badge bg-success">Marked</span>
                                    @else
                                        <span class="badge bg-info">Pending</span>
                                    @endif

                                </td>
                                <td>{{$submit->mark}}</td>


                                <td>
                                    <a class="btn btn-link"
                                       href="{{route('backend.assignments.submits.show',['subject'=>$subject,'assignment'=>$assignment,'submit'=>$submit])}}">Show</a>

                                    {{--                                    <form--}}
{{--                                        action="{{route('backend.assignments.destroy',['assignment'=>$assignment,'subject'=>$subject])}}"--}}
{{--                                        method="POST">--}}
{{--                                        @csrf--}}
{{--                                        @method('delete')--}}
{{--                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"--}}
{{--                                           href="{{route('backend.assignments.submits',['subject'=>$subject,'assignment'=>$assignment])}}"><i--}}
{{--                                                class="fa fa-eye me-2"></i> Show Submits </a>--}}
{{--                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"--}}
{{--                                           href="{{route('backend.assignments.show',['subject'=>$subject,'assignment'=>$assignment])}}"><i--}}
{{--                                                class="fa fa-eye me-2"></i> Show </a>--}}
{{--                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"--}}
{{--                                           href="{{route('backend.assignments.edit',['subject'=>$subject,'assignment'=>$assignment])}}"><i--}}
{{--                                                class="fa fa-pencil me-2"></i> edit </a>--}}
{{--                                        <a type="submit" class="text-danger font-weight-bold text-xs btn btn-link"--}}
{{--                                           onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>--}}
{{--                                    </form>--}}
                                    {{--                                    <a class="btn btn-link"--}}
                                    {{--                                       href="{{route('backend.assignments.show',['subject'=>$subject,'student'=>$student])}}">Info</a>--}}
                                    {{--                                    <button type="button" class="btn btn-link btn-sm  req-btn"--}}
                                    {{--                                            data-bs-toggle="modal" data-bs-target="#reqModal"--}}
                                    {{--                                            data-student="{{$student->id}}"--}}
                                    {{--                                            data-subject="{{$subject->id}}">Add Behavior--}}
                                    {{--                                    </button>--}}


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
