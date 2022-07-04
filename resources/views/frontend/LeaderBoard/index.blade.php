<x-front-layout>

    @include('frontend.headSection',$subject)
    <div class="container mt-5">
        <div class="course-tabs tabs-box">
            <nav class="center">
                <div class="nav nav-tabs tab-btns tab-buttons clearfix" id="nav-tab" role="tablist">
                    <li class="tab-btn active" id="nav-home-tab" data-bs-toggle="tab"
                        data-bs-target="#prod-class" type="button" role="tab" aria-controls="nav-home"
                        aria-selected="true">This Week
                    </li>
                    <li class=" tab-btn" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#prod-curriculum" type="button" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Last 30 days
                    </li>

                </div>
            </nav>
        <div class="course-tabs ">

            <div class="tab-content leaderboard-tabs w-100" id="myTabContent">
                <div class="tab-pane fade show active" id="prod-class" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list">
                        @forelse($students as $index=>$rewardPoint)
                            <div class="item">
                                <div class="pos">
                                    {{$index+1}}
                                </div>
                                <div class="pic"
                                     style="background-image: url(&#39;{{$rewardPoint->student->getLevel($subject->id)->pivot->level->getFirstMediaUrl('icon')}}&#39;)"></div>
                                <div class="name">
                                    {{$rewardPoint->student->name}}
                                </div>
                                <div class="score">
                                    {{$rewardPoint->points}}
                                </div>
                            </div>
                            @empty
                                <p>No Data</p>
                            @endforelse



                    </div>
                </div>

                <div class="tab-pane fade" id="prod-curriculum" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="list">
                        @forelse($studentMonth as $index=>$rewardPoint)
                            <div class="item">
                                <div class="pos">
                                    {{$index+1}}
                                </div>
                                <div class="pic"
                                     style="background-image: url(&#39;{{$rewardPoint->student->getLevel($subject->id)->pivot->level->getFirstMediaUrl('icon')}}&#39;)"></div>
                                <div class="name">
                                    {{$rewardPoint->student->name}}
                                </div>
                                <div class="score">
                                    {{$rewardPoint->points}}
                                </div>
                            </div>
                        @empty
                            <p>No Data</p>
                        @endforelse


                    </div>

                </div>
            </div>
        </div>

    </div>


</x-front-layout>
