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
    <div class="container mt-5">
        <div class="AuthPoints">
            <hr>
            <h3>Your Points in <a href="{{route('student.subject.learn',$subject)}}">{{$subject->name}}</a></h3>
            <p>Total : {{$totalPoints}}</p>
            <table class="table">
                <thead>
                <tr>
                    <th>Point Reason</th>
                    <th>Point Type</th>
                    <th>Count</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authPoints as $point)
                    <tr>
                        <td>{{$point->point->reason->name}}</td>
                        <td>{{$point->point->behavior[0]->human_name}}</td>
                        <td>{{$point->point->count}}</td>
                        <td>{{$point->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-front-layout>
