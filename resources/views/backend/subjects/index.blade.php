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
            <a href="{{route('backend.subjects.create')}}" @class('subject-create')>
                <i class="fa fa-plus-circle"></i>
                Create New Subject</a>

        </div>
    </div>
    <div class="row mt-2 gy-2">
        @foreach($subjects as $subject)
            <div class="col-md-6 col-xxl-4">
                <div class="card card-profile">
{{--                    @if(\Illuminate\Support\Facades\File::exists('sub_cover_img/'.$subject->cover))--}}
                        <div>
                            <img src="{{$subject->getFirstMediaUrl('cover')}}" alt="{{$subject->name}}"
                                 class="card-img-top subject-cover">
                        </div>
{{--                    @endif--}}
                    <div
                        class="card-header text-center border-0 d-flex justify-content-between d-flex align-items-center">
                        <a class="font-weight-bold py-3 "  href="{{route('backend.subjects.show',$subject)}}"><span class="font-weight-bold text-lg">
                                                                 {{$subject->name}}</span></a>
                        <form action="{{route('backend.subjects.destroy',$subject)}}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="text-secondary font-weight-bold btn btn-link"
                               href="{{route('backend.subjects.edit',$subject)}}"> <i class="fa fa-pencil me-2"></i>
                                edit </a>
                            <a type="submit" class="text-danger font-weight-bold btn btn-link"
                               onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>
                        </form>
                    </div>
                    <div class="card-body pt-0 subject-body" style="background-color: #f1eef7">
                        {!! $subject->description !!}
                    </div>
                    <div class="card-footer p-0 px-3 d-flex justify-content-between">
{{--                        <a class="text-secondary font-weight-bold py-3 "--}}
{{--                           href="{{route('backend.subjects.show',$subject)}}"> Modules </a>--}}

                        {{--                        <a class="text-secondary font-weight-bold py-3 "--}}
                        {{--                           href="{{route('backend.subjects.student',$subject)}}"> Students </a>--}}
                    </div>
                </div>
            </div>

        @endforeach

    </div>


</x-app-layout>
