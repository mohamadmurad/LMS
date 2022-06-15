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

                <div>
                    <h1>Student :{{$submit->student->name}}</h1>
                    {!! $submit->content !!}
                </div>

                @if($submit->hasMedia('submit_file'))

                    <div class="">
                        <a class="" target="_blank" href="{{$submit->getFirstMediaUrl('submit_file')}}"><i
                                class="fa fa-file me-2"></i>View</a>
                    </div>
                @endif

                @if($submit->status)
                    Mark : {{$submit->mark}}
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
                        <div class="col-md-6">
                            <button type="submit" @class('btn btn-success') >Add Mark</button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>


</x-app-layout>
