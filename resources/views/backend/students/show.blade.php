<x-app-layout>




    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    some info
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="{{asset('assets/img/imc_image_lms_schools_2021_10.jpg')}}" alt="Image placeholder"
                         class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="{{asset('assets/img/Avatar-Transparent-Image.png')}}"
                                         class="rounded-circle img-fluid border border-2 border-white">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            {{--                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>--}}
                            {{--                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>--}}
                            {{--                            <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>--}}
                            {{--                            <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>--}}
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">22</span>
                                        <span class="text-sm opacity-8">points</span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder">10</span>
                                        <span class="text-sm opacity-8">Badges</span>
                                    </div>
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">89</span>
                                        <span class="text-sm opacity-8">Courses</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <h5>
                                {{$student->name}}<span
                                    class="font-weight-light">, {{ \Illuminate\Support\Carbon::parse($student->birthDate)->age}}</span>
                            </h5>
{{--                            <div class="h6 font-weight-300">--}}
{{--                                <i class="ni location_pin mr-2"></i>Bucharest, Romania--}}
{{--                            </div>--}}
                            <div class="h6 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{$student->roles[0]->name}}
                            </div>
{{--                            <div>--}}
{{--                                <i class="ni education_hat mr-2"></i>University of Computer Science--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-app-layout>
