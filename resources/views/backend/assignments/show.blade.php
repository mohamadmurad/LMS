<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Assignment {{$assignment->name}}</li>

            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Assignments</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">

            <div class="card-body px-0 pt-0 pb-2">

                <div class="text-center">
                    <h1>{{$assignment->name}}</h1>
                    {!! $assignment->description !!}
                </div>

                @if($assignment->hasMedia('file'))

                    <div class="">
                        <a class="" target="_blank" href="{{$assignment->getFirstMediaUrl('file')}}"><i class="fa fa-file me-2"></i>View</a>
                    </div>
                @endif


            </div>
        </div>
    </div>


</x-app-layout>
