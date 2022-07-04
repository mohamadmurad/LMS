<section class="headsection">

        <!-- Single Slider -->

            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2">
                            @if(isset($subject))
                            <h1 data-animation="bounceIn" data-delay="0.2s">{{$subject->name}}</h1>
                            @endif
                            <!-- breadcrumb Start-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('subjects')}}">Subjects</a></li>
                                    @if(isset($subject))
                                    <li class="breadcrumb-item"><a href="{{route('subjects.info',$subject)}}">{{$subject->name}}</a></li>
                                    @endif
                                </ol>
                            </nav>
                            <!-- breadcrumb End -->
                        </div>
                    </div>
                </div>
            </div>


</section>
