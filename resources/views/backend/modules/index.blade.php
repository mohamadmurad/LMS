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
                    <a href="{{route('backend.modules.create',$subject)}}" @class('btn btn-success')>Create New
                        Module</a>

                </div>
                <div class="card-body pt-0 pb-2">

                    {!! $subject->description !!}

                </div>
            </div>


        </div>

    </div>
    <div class="accordion accordion-flush" id="accordionExample">
        @foreach($modules as $index=>$module)
            <div class="accordion-item card my-3 moduleItem" data-linkid="{{$module->id}}">
                <h2 class="card-header p-0" id="heading_{{$module->id}}">
                    <button @class(['accordion-button text-bold','collapsed'=>$index!=0])  class type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse_{{$module->id}}" aria-expanded="true"
                            aria-controls="collapse_{{$module->id}}">
                        <i class="fas fa-arrows-alt me-2"></i>
                        {{$module->name}}
                    </button>
                </h2>
                <div id="collapse_{{$module->id}}"
                     @class(['accordion-collapse collapse','show'=>$index==0]) class="accordion-collapse collapse "
                     aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body card-body ">
                        <form action="{{route('backend.modules.destroy',['subject'=>$subject,'module' => $module])}}"
                              method="POST">
                            @csrf
                            @method('delete')
                            <div class="d-flex gap-3">

                                <a class="btn btn-link"
                                   href="{{route('backend.modules.edit',['subject'=>$subject,'module' => $module])}}">
                                    <i class="fa fa-pencil me-2"></i>
                                    Edit
                                </a>
                                <a type="submit" class="text-danger font-weight-bold btn btn-link"
                                   onclick="delete_submit(this)">
                                    <i class="fa fa-trash me-2"></i>Delete
                                </a>
                            </div>

                        </form>
                        <div class="text-center">{!! nl2br($module->description) !!}</div>


                        <h5>Objectives</h5>
                        <ul class="list-group">
                            @foreach($module->objectives as $objective)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-white">
                                    <a class=""
                                       href="{{route('backend.objectives.show',['subject'=>$subject,'module' => $module,'objective' => $objective])}}">
                                        <i class="fa fa-book me-2"></i>{{$objective->name}}
                                        <br>
                                        <i class="fa fa-gift me-2"></i>{{$objective->points()->first()->count}} points

                                    </a>
                                    <form
                                        action="{{route('backend.objectives.destroy',['subject'=>$subject,'module' => $module,'objective' => $objective])}}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-link"
                                           href="{{route('backend.objectives.edit',['subject'=>$subject,'module' => $module, 'objective' => $objective])}}">
                                            <i class="fa fa-pencil me-2"></i>Edit</a>

                                        <a type="submit" class="text-danger font-weight-bold btn btn-link "
                                           onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>
                                    </form>

                                </li>

                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center gap-2">
                        <a href="{{route('backend.objectives.create',['subject'=>$subject,'module' => $module])}}"
                           class="subject-create">
                            <i class="fa fa-plus-circle  me-2"></i>Create Objective
                        </a>
                        {{--                        @if($module->exam)--}}
                        {{--                            <a href="{{route('teacher.module.exam.show',[--}}
                        {{--                                                                'subject'=>$subject,--}}
                        {{--                                                                'module' => $module,--}}
                        {{--                                                                'exam' => $module->exam,--}}
                        {{--                                                            ])}}" class="subject-create">--}}
                        {{--                                <i class="fa fa-book  me-2"></i>show</a>--}}
                        {{--                        @else--}}
                        {{--                            <a href="{{route('teacher.module.exam.create',[--}}
                        {{--                                                                'subject'=>$subject,--}}
                        {{--                                                                'module' => $module--}}
                        {{--                                                            ])}}" class="subject-create">--}}
                        {{--                                <i class="fa fa-book-open  me-2"></i>Create final Test</a>--}}
                        {{--                        @endif--}}


                    </div>
                </div>
            </div>

        @endforeach
    </div>

</x-app-layout>
