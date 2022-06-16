<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.index',$subject)}}">{{$subject->name}}</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Subject Levels</li>

            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Subject Levels</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Subject Levels </h6>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{route('backend.subject.level.update',$subject)}}" method="post">
                    @csrf
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Level
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Min Points
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($levels as $index=>$level)

                            <tr>
                                <td>
                                    @if($level->hasMedia('icon'))
                                        <img width="20" height="20" src="{{$level->getFirstMediaUrl('icon')}}">
                                    @endif

                                    {{$level->name}}</td>
                                <td>
                                    @if($index == 0)
                                        <input type="number" disabled name="minPoint[{{$level->id}}]"
                                               @class('form-control disabled') value="0"
                                               placeholder="Enter Level Start Points">
                                        <input type="hidden" name="minPoint[{{$level->id}}]"
                                               @class('form-control disabled') value="0"
                                               placeholder="Enter Level Start Points">
                                    @else
                                        <input type="number" name="minPoint[{{$level->id}}]" @class('form-control')
                                        placeholder="Enter Level Start Points"
                                               value="{{$level->subjectLevelMinPoints($subject->id)}}">
                                    @endif

                                </td>


                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <button @class('btn btn-primary') type="submit">Set Config</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
