<x-front-layout>

    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">{{$subject->name}}</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('subjects')}}">Subjects</a></li>
                                        <li class="breadcrumb-item"><a href="#">{{$subject->name}}</a></li>
                                    </ol>
                                </nav>
                                <!-- breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="d-flex flex-row mt-4">


        @include('frontend.aside')
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
                    <button type="submit" class="btn btn-primary">Mark as Read</button>
                </form>
            @endif


        </div>
    </div>


</x-front-layout>
