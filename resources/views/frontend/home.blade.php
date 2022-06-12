<x-front-layout>
    <!--? slider Area Start-->
    <section class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay="0.2s">Online learning<br> platform</h1>
                                <p data-animation="fadeInLeft" data-delay="0.4s">Build skills with courses,
                                    certificates, and degrees online from world-class universities and companies</p>
                                <a href="{{ route('register') }}" class="btn hero-btn" data-animation="fadeInLeft"
                                   data-delay="0.7s">Join for Free</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ? services-area -->
    <div class="services-area">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="{{asset('assets/front/img/icon/icon1.svg')}}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>60+ UX courses</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="{{asset('assets/front/img/icon/icon2.svg')}}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Expert instructors</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="{{asset('assets/front/img/icon/icon3.svg')}}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Life time access</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('frontend.courseSlider',['subjects'=>$subjects])


<!--? top subjects Area Start -->
    <div class="topic-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Explore top Categories</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $cat)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="{{asset('assets/front/img/gallery/topic6.png')}}" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">{{$cat->title}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            {{--            <div class="row justify-content-center">--}}
            {{--                <div class="col-xl-12">--}}
            {{--                    <div class="section-tittle text-center mt-20">--}}
            {{--                        <a href="courses.html" class="border-btn">View More Subjects</a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
    <!-- top subjects End -->

    <!--? About Area-3 Start -->
    <section class="about-area3 fix">
        <div class="support-wrapper align-items-center">
            <div class="right-content3">
                <!-- img -->
                <div class="right-img">
                    <img src="{{asset('assets/front/img/gallery/about3.png')}}" alt="">
                </div>
            </div>
            <div class="left-content3">
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Learner outcomes on courses you will take</h2>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="{{asset('assets/front/img/icon/right-icon.svg')}}" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Techniques to engage effectively with vulnerable children and young people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="{{asset('assets/front/img/icon/right-icon.svg')}}" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world
                            learning together.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="{{asset('assets/front/img/icon/right-icon.svg')}}" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together.
                            Online learning is as easy and natural.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->

    <!--? About Area-2 Start -->
    <section class="about-area2 fix pb-padding">
        <div class="support-wrapper align-items-center">
            <div class="right-content2">
                <!-- img -->
                <div class="right-img">
                    <img src="{{asset('assets/front/img/gallery/about2.png')}}" alt="">
                </div>
            </div>
            <div class="left-content2">
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Take the next step
                            toward your personal
                            and professional goals
                            with us.</h2>
                        <p>The automated process all your website tasks. Discover tools and techniques to engage
                            effectively with vulnerable children and young people.</p>
                        <a href="{{route('register')}}" class="btn">Join now for Free</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
</x-front-layout>
