<x-front-layout>
    <!--? slider Area Start-->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Our Subjects</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Services</a></li>
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
    <!-- Courses area start -->
    <div class="courses-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Our featured Subjects</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($subjects as $subject)
                    <div class="col-lg-4">
                        <div class="properties properties2 mb-30">
                            <div class="properties__card">
                                <div class="properties__img overlay1">
                                    <a href="{{route('subjects.info',$subject)}}"><img src="{{$subject->getFirstMediaUrl('cover')}}" alt=""></a>
                                </div>
                                <div class="properties__caption">
                                    <p>{{$subject->category->title}}</p>
                                    <h3><a href="{{route('subjects.info',$subject)}}">{{$subject->name}}</a></h3>
                                    <p> {!! $subject->description !!}</p>
                                    <div class="properties__footer d-flex justify-content-between align-items-center">
                                        <div class="restaurant-name">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half"></i>
                                            </div>
                                            <p><span>(4.5)</span> based on 120</p>
                                        </div>
                                        <div class="price">
                                            <span>$135</span>
                                        </div>
                                    </div>
                                    <a href="{{route('subjects.info',$subject)}}" class="border-btn border-btn2">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <!-- Courses area End -->

</x-front-layout>