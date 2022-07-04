<x-front-layout>

    @include('frontend.headSection',$subject)

    <div class="d-flex flex-row mt-4">


        @include('frontend.aside')
        <div class="sidebar-widget review-widget w-100 ms-5 me-5" >
            <div class="widget-content">
                <div class="content">
        <div class="container text-center">

            @if($objective->getFirstMediaUrl('videos'))
                <div @class('text-center')>
                    <video src="{{$objective->getFirstMediaUrl('videos')}}" controls>

                    </video>
                </div>

            @else
                {!!  $objective->content !!}
            @endif

            @if($objective->isSeen()->count()<1)
                <form action="{{route('student.obj.seen',['subject'=>$subject,'objective'=>$objective])}}"
                      method="post">
                    @csrf
                    <button type="submit" class="theme-btn btn-style-two"><span class="txt">Mark as Read</span></button>
                </form>
            @endif


        </div>
                </div>
            </div>
        </div>
    </div>


</x-front-layout>
