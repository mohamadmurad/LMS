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
            <div class="text-center">
                <h1>{{$assignment->name}}</h1>
                {!! $assignment->description !!}
            </div>
            @if($assignment->hasMedia('file'))

                <div class="">
                    <a class="" target="_blank" href="{{$assignment->getFirstMediaUrl('file')}}"><i
                            class="fa fa-file me-2"></i>View</a>
                </div>
            @endif

            @if(!$assignment->submitAuth)
                <div class="text-start">
                    <h3>Submit Your Assignment</h3>
                    <form class="text-start" method="POST" enctype="multipart/form-data"
                          action="{{ route('student.subject.assignment.store',['subject'=>$subject,'assignment' => $assignment]) }}">
                        @csrf
                        <div class="row gap-3">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Content</label>
                                        <textarea
                                            @class('form-control editor') name="content">{{old('content')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">File (optional)</label>
                                    <input class="form-control" type="file"
                                           name="file" value="{{old('file')}}" autocomplete="subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            @else
                <div class="text-start">
                    <h3>Your Submit <span
                            class="badge {{$assignment->submitAuth->status == 0 ? 'bg-info':'bg-success'}}">{{$assignment->submitAuth->status == 0 ? 'Pending':'Marked'}}</span>
                    </h3>
                    @if($assignment->submitAuth->status)
                        <h4>Mark : {{$assignment->submitAuth->mark}}</h4>
                    @endif
                    {!! $assignment->submitAuth->content !!}

                    @if($assignment->submitAuth->hasMedia('submit_file'))

                        <div class="">
                            <a class="" target="_blank"
                               href="{{$assignment->submitAuth->getFirstMediaUrl('submit_file')}}"><i
                                    class="fa fa-file me-2"></i>View</a>
                        </div>
                    @endif
                </div>
                @if($assignment->submitAuth->status)
                <div class="questions">

                    <h3>You have achieved this objective</h3>

                    <div class="row">
                        @foreach($objectives as $objective)
                            <div class="col-md-2">
                                <p>{{$objective->name}}
                                    @if(in_array($objective->id, $assignment->submitAuth->achieved()) )
                                        <i class="fas fa-check-circle color-green"></i>
                                    @else
                                        <i class="fas fa-times-circle color-red"></i>
                                    @endif
                                </p>
                            </div>
                        @endforeach

                    </div>
                    <h3>Feedback</h3>
                    <p>{{$assignment->submitAuth->feedback}}</p>

                </div>
                @endif
            @endif


        </div>
    </div>

</x-front-layout>
