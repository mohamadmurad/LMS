<x-front-layout>

    @include('frontend.headSection',$subject)


    <div class="d-flex flex-row mt-4">


        @include('frontend.aside')
        <div class="container ">

            <div class="sec-title">
                <h4>Quiz</h4>
            </div>


            <div class="testview-section">
                <div class="inner-container">
                    <!-- Upper Box -->
                    <div class="upper-box">
                        <!-- Question Box -->
                        <div class="question-box">
                            <div class="row clearfix">

                                <!-- Column -->
                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                    <h6>Questions</h6>
                                    <div class="question">{{$exam->questions()->count()}} <span>Questions</span></div>
                                </div>
                                @if($exam->authSubmit->first())
                                <!-- Column -->
                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                    <h6>Your Mark</h6>
                                    <div class="question"> {{$exam->authSubmit->first()->final_mark}} <span>%</span></div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- Lower Box -->
                    <div class="lower-box">




                        <!-- Quiz Form -->
                        <div class="quiz-form">
                            @if(!$exam->authSubmit()->first())
                                <form
                                    action="{{route('student.subject.exam.submit',['subject'=>$subject,'exam'=>$exam])}}"
                                    method="post">
                                    @endif
                                    @csrf

                                    @foreach($exam->questions as $index=>$question)
                                        <h6>{{$index+1 }}. {{$question->question}}:

                                            @if($exam->authSubmit->first())
                                                @if( $exam->authSubmit()->first()->correctQuestion($question->id) )
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
                                                                   {{$exam->authSubmit()->first() ? 'disabled' :''}}
                                                                   {{$exam->authSubmit()->first() &&  $exam->authSubmit()->first()->optionIDQuestion($question->id) == $option->id ? 'checked':''}}
                                                                   id="inlineRadio1{{$option->id}}"
                                                                   value="{{$option->id}}">
                                                            <label class="form-check-label"
                                                                   for="inlineRadio1{{$option->id}}">{{$option->option}}</label>
                                                            @if($exam->authSubmit->first() && $option->correct)
                                                                <i class="fas fa-check-circle color-green"></i>
                                                            @endif
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





                                    @if(!$exam->authSubmit()->first())
                                        <div class="form-group text-right">
                                            <button class="theme-btn btn-style-one" type="submit" name="submit-form">
                                                <span class="txt">Submit Test</span></button>
                                        </div>

                                </form>
                            @endif

                                @if($exam->authSubmit()->first())
                                    <a class="theme-btn btn-style-two"
                                       href="{{route('student.subject.learnObjective',['subject'=>$subject,'objective'=>$lastSeenObjective])}}">
                                        <span class="txt">
                                            continue</span></a>
                                @endif

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>


</x-front-layout>
