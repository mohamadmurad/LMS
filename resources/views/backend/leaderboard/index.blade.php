<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Leader board</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Leader board</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">


                <div class="container">
                    <div class="frame">
                        <header>Leaderboard</header>
                        <ul class="nav nav-tabs button-group" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <span>This Week</span></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    <span> Last 30 days</span>
                                   </button>
                            </li>

                        </ul>
                        <div class="tab-content w-100" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="score-card">
                                    @foreach($students as $index=>$rewardPoint)
                                        <div class="leader">
                                            <div class="user">
                                                <div class="number">{{$index+1}}</div>
                                                <div class="user-pic"></div>
                                            </div>
                                            <div class="user-info">
                                                <div class="user-name">{{$rewardPoint->student->name}}</div>
                                                <div class="view-count">{{$rewardPoint->points}} Points</div>
                                            </div>
                                            <div class="gallery">
                                                <div class="gallery-item">
                                                    <img class="img-fluid"
                                                         src="{{$rewardPoint->student->getLevel($subject->id)->pivot->level->getFirstMediaUrl('icon')}}">
                                                </div>
                                                {{--                                        <div class="gallery-item"></div>--}}
                                                {{--                                        <div class="gallery-item"></div>--}}
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="score-card">
                                    @foreach($studentMonth as $index=>$rewardPoint)
                                        <div class="leader">
                                            <div class="user">
                                                <div class="number">{{$index+1}}</div>
                                                <div class="user-pic"></div>
                                            </div>
                                            <div class="user-info">
                                                <div class="user-name">{{$rewardPoint->student->name}}</div>
                                                <div class="view-count">{{$rewardPoint->points}} Points</div>
                                            </div>
                                            <div class="gallery">
                                                <div class="gallery-item">
                                                    <img class="img-fluid"
                                                         src="{{$rewardPoint->student->getLevel($subject->id)->pivot->level->getFirstMediaUrl('icon')}}">
                                                </div>
                                                {{--                                        <div class="gallery-item"></div>--}}
                                                {{--                                        <div class="gallery-item"></div>--}}
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>


</x-app-layout>
