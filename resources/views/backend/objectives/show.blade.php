<x-app-layout>
    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('backend.subjects.index')}}">Subjects</a></li>
                <li class="breadcrumb-item text-sm text-white " aria-current="page"><a class="opacity-5 text-white" href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{$module->name}}</li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{$objective->name}}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{$objective->name}}</h6>
        </nav>
    @endsection
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>{{$objective->name}}</h6>
                </div>
                <div class="card-body  pb-2">

                    @if( $objective->getFirstMediaUrl('videos'))
                        <div @class('text-center')>
                            <video class="w-75" src="{{$objective->getFirstMediaUrl('videos')}}" controls>

                            </video>
                        </div>

                    @endif

                    {!!  $objective->content !!}

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
