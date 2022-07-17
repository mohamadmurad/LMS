@if(isset($notifications))
    @foreach($notifications as $notification)
        @php
            $bg = $notification['read_at']==null ?"#f1f1f1":"#ffffff";
        @endphp
        <li class="mb-2 dropdown-item border-radius-md">
{{--            <a class="dropdown-item border-radius-md" href="javascript:;" style="background:{{$bg}} ">--}}
                <div class="d-flex py-1">
                    {{--                                        <div class="my-auto">--}}
                    {{--                                            <img--}}
                    {{--                                                --}}{{--                                            src="./assets/img/team-2.jpg"--}}
                    {{--                                                @if(isset($notification['image']) && $notification['image']!=null)--}}
                    {{--                                                    src="{{$notification['image']}}"--}}
                    {{--                                                @else--}}
                    {{--                                                    src="{{ env('DEFAULT_IMAGE_NOTIFICATION') }}"--}}
                    {{--                                                @endif--}}
                    {{--                                                class="avatar avatar-sm  me-3 ">--}}
                    {{--                                        </div>--}}
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                            @if($notification['read_at']==null)
                                <span
                                    class="font-weight-bold">New Notification</span>
                            @endif
                            {!!$notification->data['message']!!}
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1" aria-hidden="true"></i>
                            {{\Illuminate\Support\Carbon::parse($notification['created_at'])->diffForHumans()}}
                        </p>
                    </div>
                </div>
{{--            </a>--}}
        </li>
    @endforeach
@if(count($notifications)==0)
    <li class="mb-2">

        <div class="d-flex py-1">

            <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                    No Notification
                </h6>

            </div>
        </div>

    </li>

@endif
@endif
