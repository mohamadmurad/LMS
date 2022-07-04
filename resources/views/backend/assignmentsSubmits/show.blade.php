<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    Assignment {{$assignment->name}}</li>

            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Assignments</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">

            <div class="card-body px-0 pt-0 pb-2">
                {{--                <div id="root">--}}

                {{--                    <div class="notice start-warning" id="js-enabled">--}}

                {{--                    </div>--}}
                {{--                </div>--}}

                <div>
                    <h1>Student :{{$submit->student->name}}</h1>
                    {!! $submit->content !!}
                </div>

                @if($submit->getFirstMedia('submit_file')->getExtensionAttribute() == 'sb3')
                    <div class="w-100">
                        <iframe id="myframe" src="{{route('ss',['submit'=>$submit])}}" style="    width: 100%;    height: 500px;"></iframe>
                    </div>

                @endif



                @if($submit->hasMedia('submit_file'))

                    <div class="">
                        <a class="" target="_blank" href="{{$submit->getFirstMediaUrl('submit_file')}}"><i
                                class="fa fa-file me-2"></i>View</a>
                    </div>
                @endif

                @if($submit->status)
                    Mark : {{$submit->mark}}

                    <div class="questions">
                        @foreach($objectives as $objective)
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="objective[{{$objective->id}}]" {{in_array($objective->id, $submit->achieved()) ? 'checked' : ''}} disabled
                                               id="objective_{{$objective->id}}_correct">
                                        <label class="form-check-label"
                                               for="objective_{{$objective->name}}_correct"></label>
                                    </div>

                                </div>
                                <div class="col-md-10">
                                    <p>{{$objective->name}}</p>
                                </div>
                            </div>

                        @endforeach
                    </div>

                @else
                    <form method="post"
                          action="{{route('backend.assignments.submits.mark',['subject'=>$subject,'assignment'=>$assignment,'submit'=>$submit])}}">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Mark</label>
                                <input class="form-control" type="number" name="mark" value="{{old('mark')}}"
                                >
                                @error('mark') <span>{{$errors->mark}}</span> @enderror
                            </div>
                        </div>
                        <p>Objectives that have been achieved</p>
                        <div class="questions">
                            @foreach($objectives as $objective)
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                   name="objective[{{$objective->id}}]"
                                                   id="objective_{{$objective->id}}_correct">
                                            <label class="form-check-label"
                                                   for="objective_{{$objective->name}}_correct"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-10">
                                        <p>{{$objective->name}}</p>
                                    </div>
                                </div>

                            @endforeach
                        </div>


                        <div class="col-md-6">
                            <button type="submit" @class('btn btn-success') >Add Mark</button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>


    @section('scripts')
        {{--        <script>--}}

        {{--            var myFrame = $("#myframe").contents().find('body');--}}
        {{--           // var textareaValue = $("textarea").val();--}}
        {{--            myFrame.html({{$html}});--}}

        {{--        </script>--}}
    @endsection
</x-app-layout>
