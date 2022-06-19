<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>

                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Placements</li>

            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Placement</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Placements </h6>
                <a href="{{route('backend.placements.create')}}" @class('btn btn-success')>Create New
                    Placement</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Placement Name
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Question Count</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($placements as $exam)
                            <tr>
                                <td>{{$exam->name}}</td>
                                <td>{{$exam->subject->name}}</td>
                                <td>{{$exam->questions_count}}</td>
{{--                                <td>{{$question->objective->module->name}} --> {{$question->objective->name}}</td>--}}
{{--                                <td>--}}
{{--                                    @foreach($question->options as $op)--}}
{{--                                        <span--}}
{{--                                            class="badge {{$op->correct? 'bg-success':"bg-info"}}">{{$op->option}}</span>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}


                                <td>
                                    <form
                                        action="{{route('backend.placements.destroy',['placement'=>$exam])}}"
                                        method="POST">
                                        @csrf
                                        @method('delete')

                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                           href="{{route('backend.placements.show',['placement'=>$exam])}}"><i
                                                class="fa fa-eye me-2"></i> Show </a>
                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                           href="{{route('backend.placements.edit',['placement'=>$exam])}}"><i
                                                class="fa fa-pencil me-2"></i> edit </a>
                                        <a type="submit" class="text-danger font-weight-bold text-xs btn btn-link"
                                           onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>
                                    </form>



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
