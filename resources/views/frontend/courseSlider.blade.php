
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
        <div class="courses-actives">
        @foreach($subjects as $subject)
            <!-- Single -->
                <div class="properties pb-20">
                    <div class="properties__card">
                        <div class="properties__img overlay1">
                            <a href="{{route('subjects.info',$subject)}}"><img src="{{$subject->getFirstMediaUrl('cover')}}" alt="{{$subject->name}}"></a>
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
                <!-- Single -->
            @endforeach

            {{--                <!-- Single -->--}}
            {{--                <div class="properties pb-20">--}}
            {{--                    <div class="properties__card">--}}
            {{--                        <div class="properties__img overlay1">--}}
            {{--                            <a href="#"><img src="assets/img/gallery/featured2.png" alt=""></a>--}}
            {{--                        </div>--}}
            {{--                        <div class="properties__caption">--}}
            {{--                            <p>User Experience</p>--}}
            {{--                            <h3><a href="#">Fundamental of UX for Application design</a></h3>--}}
            {{--                            <p>The automated process all your website tasks. Discover tools and techniques to engage effectively with vulnerable children and young people.--}}
            {{--                            </p>--}}
            {{--                            <div class="properties__footer d-flex justify-content-between align-items-center">--}}
            {{--                                <div class="restaurant-name">--}}
            {{--                                    <div class="rating">--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star-half"></i>--}}
            {{--                                    </div>--}}
            {{--                                    <p><span>(4.5)</span> based on 120</p>--}}
            {{--                                </div>--}}
            {{--                                <div class="price">--}}
            {{--                                    <span>$135</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <a href="#" class="border-btn border-btn2">Find out more</a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!-- Single -->--}}
            {{--                <!-- Single -->--}}
            {{--                <div class="properties pb-20">--}}
            {{--                    <div class="properties__card">--}}
            {{--                        <div class="properties__img overlay1">--}}
            {{--                            <a href="#"><img src="assets/img/gallery/featured3.png" alt=""></a>--}}
            {{--                        </div>--}}
            {{--                        <div class="properties__caption">--}}
            {{--                            <p>User Experience</p>--}}
            {{--                            <h3><a href="#">Fundamental of UX for Application design</a></h3>--}}
            {{--                            <p>The automated process all your website tasks. Discover tools and techniques to engage effectively with vulnerable children and young people.--}}

            {{--                            </p>--}}
            {{--                            <div class="properties__footer d-flex justify-content-between align-items-center">--}}
            {{--                                <div class="restaurant-name">--}}
            {{--                                    <div class="rating">--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star-half"></i>--}}
            {{--                                    </div>--}}
            {{--                                    <p><span>(4.5)</span> based on 120</p>--}}
            {{--                                </div>--}}
            {{--                                <div class="price">--}}
            {{--                                    <span>$135</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <a href="#" class="border-btn border-btn2">Find out more</a>--}}
            {{--                        </div>--}}

            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!-- Single -->--}}
            {{--                <!-- Single -->--}}
            {{--                <div class="properties pb-20">--}}
            {{--                    <div class="properties__card">--}}
            {{--                        <div class="properties__img overlay1">--}}
            {{--                            <a href="#"><img src="assets/img/gallery/featured2.png" alt=""></a>--}}
            {{--                        </div>--}}
            {{--                        <div class="properties__caption">--}}
            {{--                            <p>User Experience</p>--}}
            {{--                            <h3><a href="#">Fundamental of UX for Application design</a></h3>--}}
            {{--                            <p>The automated process all your website tasks. Discover tools and techniques to engage effectively with vulnerable children and young people.--}}

            {{--                            </p>--}}
            {{--                            <div class="properties__footer d-flex justify-content-between align-items-center">--}}
            {{--                                <div class="restaurant-name">--}}
            {{--                                    <div class="rating">--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star"></i>--}}
            {{--                                        <i class="fas fa-star-half"></i>--}}
            {{--                                    </div>--}}
            {{--                                    <p><span>(4.5)</span> based on 120</p>--}}
            {{--                                </div>--}}
            {{--                                <div class="price">--}}
            {{--                                    <span>$135</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <a href="#" class="border-btn border-btn2">Find out more</a>--}}
            {{--                        </div>--}}

            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!-- Single -->--}}
        </div>
    </div>
</div>
<!-- Courses area End -->
