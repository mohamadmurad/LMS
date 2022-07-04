<x-front-layout>
    @include('frontend.headSection')
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
                                   <div class="desc">
                                       {!! $subject->description !!}
                                   </div>

                                    <div class="properties__footer d-flex justify-content-between align-items-center">
                                        <div class="restaurant-name">
                                            <div class="rating">
                                                @for($i = 0; $i< floor($subject->reviews()->avg('stars')) ;$i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor

                                            </div>
                                            <p><span>({{floor($subject->reviews()->avg('stars'))}})</span> based on {{$subject->reviews()->count()}}</p>
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
