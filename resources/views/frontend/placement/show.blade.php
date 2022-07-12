<x-front-layout>

    @include('frontend.headSection',$subject)


    <div class="d-flex flex-row mt-4">
        <div class="sidebar-widget review-widget w-100 ms-5 me-5">
            <div class="widget-content">
                <div class="content">

                    <div class="container ">

                        <div class="sec-title">
                            <h4>Placement</h4>
                        </div>
                        <div class="testview-section">
                            <div class="inner-container">
                                <!-- Upper Box -->
                                <div class="upper-box">
                                    <!-- Question Box -->
                                    <div class="question-box">
                                        <div class="row clearfix">

                                            <!-- Column -->
                                            <div class="column col-lg-12 col-md-6 col-sm-12">
                                                <h6>Questions</h6>
                                                <div class="question">{{$placement->questions()->count()}} <span>Questions</span></div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- Lower Box -->
                                <div class="lower-box">

                                    <!-- Quiz Form -->
                                    <div class="quiz-form">
                                        @if(!$placement->authSubmit()->first())
                                            <form
                                                action="{{route('student.subject.placement.submit',['subject'=>$subject,'placement'=>$placement])}}"
                                                method="post">
                                                @endif
                                                @csrf
                                                @foreach($placement->questions as $index=>$question)
                                                    <h6>{{$index+1 }}. {{$question->question}}:




                                                        @if($placement->authSubmit->first())
                                                            @if( $placement->authSubmit()->first()->correctQuestion($question->id) )
                                                                <i class="fas fa-check-circle color-green"></i>
                                                            @else
                                                                <i class="fas fa-times-circle color-red"></i>
                                                            @endif
                                                        @endif

                                                    </h6>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-grow-1">
                                                                @foreach($question->options as $option)
                                                                    <div class="form-check ">
                                                                        <input required class="form-check-input" type="radio"
                                                                               name="option[{{$question->id}}]"
                                                                               {{$placement->authSubmit()->first() ? 'disabled' :''}}
                                                                               {{$placement->authSubmit()->first() &&  $placement->authSubmit()->first()->optionIDQuestion($question->id) == $option->id ? 'checked':''}}
                                                                               id="inlineRadio1{{$option->id}}" value="{{$option->id}}">
                                                                        <label class="form-check-label"
                                                                               for="inlineRadio1{{$option->id}}">{{$option->option}}</label>
                                                                    </div>
                                                                @endforeach
                                                        </div>

                                                        @if($question->hasMedia('q_files'))

                                                            <div class="">
                                                                <a class="" target="_blank"
                                                                   href="{{$question->getFirstMediaUrl('q_files')}}"><i
                                                                        class="fa fa-file me-2"></i>View</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                @if(!$placement->authSubmit()->first())
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                            </form>
                                        @endif
                                        @if($placement->authSubmit()->first())
                                            <a class="btn btn-primary"
                                               href="{{route('student.subject.learnObjective',['subject'=>$subject,'objective'=>$lastSeenObjective])}}">continue</a>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


</x-front-layout>
