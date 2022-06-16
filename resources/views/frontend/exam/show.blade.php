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
        <div class="container ">
            @if(!$exam->authSubmit()->first())
                <form action="{{route('student.subject.exam.submit',['subject'=>$subject,'exam'=>$exam])}}"
                      method="post">
                    @endif
                    @csrf
                    @foreach($exam->questions as $index=>$question)

                        <div class="d-flex mb-2">

                            <div class="flex-grow-1">
                                <p>{{$index+1 }}. {{$question->question}}:</p>

                                <div class="">

                                    @if($exam->authSubmit->first())
                                        @if( $exam->authSubmit()->first()->correctQuestion($question->id) )
                                            <svg fill="#1F8354" class="_ufjrdd" viewBox="0 0 48 48" role="img"
                                                 aria-labelledby="Completedd75e1050-e1de-4d77-d4f6-e07d1ea8e3e7 Completedd75e1050-e1de-4d77-d4f6-e07d1ea8e3e7Desc"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 style="fill: rgb(54, 59, 66); height: 20px; width: 20px; margin-right: 12px;">
                                                <title id="Completedd75e1050-e1de-4d77-d4f6-e07d1ea8e3e7">
                                                    Completed</title>
                                                <path
                                                    d="M1 24C1 11.318375 11.318375 1 24 1s23 10.318375 23 23-10.318375 23-23 23S1 36.681625 1 24zm20.980957 4.2558594l-7.7418213-7.0596924L12 23.5592041l9.980957 9.6016846 15.2832032-16.4852295L34.9130859 14 21.980957 28.2558594z"
                                                    fill="#1F8354" role="presentation"></path>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                 style="fill: rgb(221 51 51); height: 20px; width: 20px; margin-right: 12px;">
                                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM175 208.1L222.1 255.1L175 303C165.7 312.4 165.7 327.6 175 336.1C184.4 346.3 199.6 346.3 208.1 336.1L255.1 289.9L303 336.1C312.4 346.3 327.6 346.3 336.1 336.1C346.3 327.6 346.3 312.4 336.1 303L289.9 255.1L336.1 208.1C346.3 199.6 346.3 184.4 336.1 175C327.6 165.7 312.4 165.7 303 175L255.1 222.1L208.1 175C199.6 165.7 184.4 165.7 175 175C165.7 184.4 165.7 199.6 175 208.1V208.1z"/>
                                            </svg>
                                        @endif
                                    @endif
                                    @foreach($question->options as $option)
                                        <div class="form-check ">
                                            <input required class="form-check-input" type="radio"
                                                   name="option[{{$question->id}}]"
                                                   {{$exam->authSubmit()->first() ? 'disabled' :''}}
                                                   {{$exam->authSubmit()->first() &&  $exam->authSubmit()->first()->optionIDQuestion($question->id) == $option->id ? 'checked':''}}
                                                   id="inlineRadio1{{$option->id}}" value="{{$option->id}}">
                                            <label class="form-check-label"
                                                   for="inlineRadio1{{$option->id}}">{{$option->option}}</label>
                                        </div>
                                    @endforeach

                                </div>

                            </div>

                            @if($question->hasMedia('q_files'))

                                <div class="">
                                    <a class="" target="_blank" href="{{$question->getFirstMediaUrl('q_files')}}"><i
                                            class="fa fa-file me-2"></i>View</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    @if(!$exam->authSubmit()->first())
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                </form>
            @endif
            @if($exam->authSubmit()->first())
                <a class="btn btn-primary"
                   href="{{route('student.subject.learnObjective',['subject'=>$subject,'objective'=>$lastSeenObjective])}}">continue</a>
            @endif
        </div>
    </div>


</x-front-layout>
