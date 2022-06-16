<aside>
    <div class="">
        <ul class="objectives list-group ">
            @foreach($module->objectives as $obj)
                <li class="{{request()->objective ? request()->objective->id == $obj->id ? 'active':'' : ''}}">
                    <a class="d-flex"
                       href="{{route('student.subject.learnObjective',['subject'=>$subject,'objective'=>$obj])}}">
                        <div class="icon">
                            @if($obj->isSeen()->count()>0)
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
                                @if($obj->type)
                                    <svg aria-hidden="true" class="_ufjrdd" viewBox="0 0 48 48" role="img"
                                         aria-labelledby="Videof38a160b-4750-48aa-ce2a-5b671137eb84 Videof38a160b-4750-48aa-ce2a-5b671137eb84Desc"
                                         xmlns="http://www.w3.org/2000/svg"
                                         style="fill: rgb(54, 59, 66); height: 20px; width: 20px; margin-right: 12px;">
                                        <title id="Videof38a160b-4750-48aa-ce2a-5b671137eb84">Video</title>
                                        <path
                                            d="M19 33.94V15l15 9.47-15 9.47zM24 47C11.3 47 1 36.7 1 24S11.3 1 24 1s23 10.3 23 23-10.3 23-23 23zm0-1.84c11.7 0 21.16-9.47 21.16-21.16C45.16 12.3 35.7 2.84 24 2.84 12.3 2.84 2.84 12.3 2.84 24c0 11.7 9.47 21.16 21.16 21.16z"
                                            role="presentation"></path>
                                    </svg>
                                @else
                                    <svg aria-hidden="true" class="_ufjrdd" viewBox="0 0 48 48" role="img"
                                         aria-labelledby="Quiz3f672b2a-a7ad-46e6-dc43-8cca9bbaa4ec Quiz3f672b2a-a7ad-46e6-dc43-8cca9bbaa4ecDesc"
                                         xmlns="http://www.w3.org/2000/svg"
                                         style="fill: rgb(54, 59, 66); height: 20px; width: 20px; margin-right: 12px;">
                                        <title id="Quiz3f672b2a-a7ad-46e6-dc43-8cca9bbaa4ec">Quiz</title>
                                        <path
                                            d="M24 47C11.3 47 1 36.7 1 24S11.3 1 24 1s23 10.3 23 23-10.3 23-23 23zm0-1.84c11.7 0 21.16-9.47 21.16-21.16C45.16 12.3 35.7 2.84 24 2.84 12.3 2.84 2.84 12.3 2.84 24c0 11.7 9.47 21.16 21.16 21.16zM21 17h10v2H21v-2zm0 6h10v2H21v-2zm0 6h10v2H21v-2zm-3-10c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-5-21h22v28H13V10zm2 2v24h18V12H15z"
                                            role="presentation"></path>
                                    </svg>
                                @endif
                            @endif

                        </div>
                        <div class="title">{{$obj->name}}</div>
                    </a>
                </li>

            @endforeach
            @foreach($module->assignments as $ass)
                <li class="{{request()->assignment ? request()->assignment->id == $ass->id ? 'active':'':''}}">
                    <a class="d-flex"
                       href="{{route('student.subject.assignment',['subject'=>$subject,'assignment'=>$ass])}}">
                        <div class="icon">
                            @if($ass->submitAuth)
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
                                <svg aria-hidden="true" class="_ufjrdd" viewBox="0 0 48 48" role="img"
                                     aria-labelledby="Quiz3f672b2a-a7ad-46e6-dc43-8cca9bbaa4ec Quiz3f672b2a-a7ad-46e6-dc43-8cca9bbaa4ecDesc"
                                     xmlns="http://www.w3.org/2000/svg"
                                     style="fill: rgb(54, 59, 66); height: 20px; width: 20px; margin-right: 12px;">
                                    <title id="Quiz3f672b2a-a7ad-46e6-dc43-8cca9bbaa4ec">Quiz</title>
                                    <path
                                        d="M24 47C11.3 47 1 36.7 1 24S11.3 1 24 1s23 10.3 23 23-10.3 23-23 23zm0-1.84c11.7 0 21.16-9.47 21.16-21.16C45.16 12.3 35.7 2.84 24 2.84 12.3 2.84 2.84 12.3 2.84 24c0 11.7 9.47 21.16 21.16 21.16zM21 17h10v2H21v-2zm0 6h10v2H21v-2zm0 6h10v2H21v-2zm-3-10c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-5-21h22v28H13V10zm2 2v24h18V12H15z"
                                        role="presentation"></path>
                                </svg>
                            @endif

                        </div>
                        <div class="title"><b>Assignment:</b> {{$ass->name}}</div>
                    </a>
                </li>

            @endforeach
            @if($module->exams()->count() > 0)
                @foreach($module->exams as $exam)
                    <li class=" {{request()->exam ? request()->exam->id == $exam->id ? 'active':'':''}} ">
                        <a class="d-flex"
                           href="{{route('student.subject.exam.show',['subject'=>$subject,'exam'=>$exam])}}"
                        >
                            <div class="icon">
                                @if($exam->authSubmit->first())
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
                                    <svg aria-hidden="true" class="_ufjrdd" viewBox="0 0 48 48" role="img"
                                         aria-labelledby="Quiz500a3ccf-7fb4-468b-8a48-70ca48f6a586 Quiz500a3ccf-7fb4-468b-8a48-70ca48f6a586Desc"
                                         xmlns="http://www.w3.org/2000/svg"
                                         style="fill: rgb(54, 59, 66); height: 20px; width: 20px; margin-right: 12px;">
                                        <title id="Quiz500a3ccf-7fb4-468b-8a48-70ca48f6a586">Quiz</title>
                                        <path
                                            d="M24 47C11.3 47 1 36.7 1 24S11.3 1 24 1s23 10.3 23 23-10.3 23-23 23zm0-1.84c11.7 0 21.16-9.47 21.16-21.16C45.16 12.3 35.7 2.84 24 2.84 12.3 2.84 2.84 12.3 2.84 24c0 11.7 9.47 21.16 21.16 21.16zM21 17h10v2H21v-2zm0 6h10v2H21v-2zm0 6h10v2H21v-2zm-3-10c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm0 6c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-5-21h22v28H13V10zm2 2v24h18V12H15z"
                                            role="presentation"></path>
                                    </svg>
                                @endif

                            </div>
                            <div class="title"><b>Exam:</b> {{$exam->name}}</div>
                        </a>
                    </li>
                @endforeach

            @endif

        </ul>


    </div>
</aside>
