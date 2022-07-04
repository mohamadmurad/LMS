<!-- Review Comments Box -->
<div class="review-comments-box">
    <h6>Reviews</h6>
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <!-- New Comment //-->
        @auth()
            <div class="d-flex">
                <div class="flex-grow-1">
                    <div class="hstack gap-2 mb-1 fw-bold link-dark me-1">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </div>
                    <form wire:submit.prevent="submit">
                        <fieldset class="rating">
                            <input type="radio" wire:model="stars" id="star5" name="rating"
                                   value="5"/><label
                                class="full" for="star5" title="Awesome - 5 stars"><i
                                    class="fa fa-star"></i></label>
                            {{--                                    <input type="radio" wire:model="stars" id="star4half" name="rating"--}}
                            {{--                                           value="4.5"/><label class="half" for="star4half"--}}
                            {{--                                                               title="Pretty good - 4.5 stars"></label>--}}
                            <input type="radio" wire:model="stars" id="star4" name="rating"
                                   value="4"/><label
                                class="full" for="star4" title="Pretty good - 4 stars"><i
                                    class="fa fa-star"></i></label>
                            {{--                                    <input type="radio" wire:model="stars" id="star3half" name="rating"--}}
                            {{--                                           value="3.5"/><label class="half" for="star3half"--}}
                            {{--                                                               title="Meh - 3.5 stars"></label>--}}
                            <input type="radio" wire:model="stars" id="star3" name="rating"
                                   value="3"/><label
                                class="full" for="star3" title="Meh - 3 stars"><i
                                    class="fa fa-star"></i></label>
                            {{--                                    <input type="radio" wire:model="stars" id="star2half" name="rating"--}}
                            {{--                                           value="2.5"/><label class="half" for="star2half"--}}
                            {{--                                                               title="Kinda bad - 2.5 stars"></label>--}}
                            <input type="radio" wire:model="stars" id="star2" name="rating"
                                   value="2"/><label
                                class="full" for="star2" title="Kinda bad - 2 stars"><i
                                    class="fa fa-star"></i></label>
                            {{--                                    <input type="radio" wire:model="stars" id="star1half" name="rating"--}}
                            {{--                                           value="1.5"/><label class="half" for="star1half"--}}
                            {{--                                                               title="Meh - 1.5 stars"></label>--}}
                            <input type="radio" wire:model="stars" id="star1" name="rating"
                                   value="1"/><label
                                class="full" for="star1" title="Sucks big time - 1 star"><i
                                    class="fa fa-star"></i></label>
                            {{--                                    <input type="radio" wire:model="stars" id="starhalf" name="rating"--}}
                            {{--                                           value="0.5"/><label class="half" for="starhalf"--}}
                            {{--                                                               title="Sucks big time - 0.5 stars"></label>--}}
                        </fieldset>
                        <div class="form-floating mb-3">

                  <textarea class="form-control w-100" wire:model="comment" required
                            placeholder="Leave a comment here"
                            id="my-comment"
                            style="height:7rem;"></textarea>
                            @error('comment') <span class="error">{{ $message }}</span> @enderror
                            <label for="my-comment">Leave a comment here</label>
                        </div>
                        <div class="hstack justify-content-end gap-2">
                            <button class="btn btn-sm btn-primary text-uppercase" type="submit">comment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth

    </div>
    @foreach($reviews as $review)

        <!-- Reviewer Comment Box -->
        <div class="reviewer-comment-box">
            <h4>{{$review->student->name}}</h4>
            <div class="rating">
                <span class="total-rating">{{$review->stars}}</span>
                @for($i = 0 ;$i<$review->stars;$i++)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>

                @endfor
                @for($j = $i ;$j<5;$j++)
                    <svg xmlns="http://www.w3.org/2000/svg" class="light" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg>
                @endfor



                {{$review->created_at}}
            </div>
            <div class="text">{!! nl2br($review->comment) !!}</div>


        </div>
    @endforeach

</div>


{{--<div>--}}
{{--    <div class="reviews">--}}

{{--        <div class="app container py-4">--}}
{{--            <div class="col-md-12 col-lg-10 m-auto">--}}

{{--                <div class="bg-white rounded-3 shadow-sm p-4">--}}

{{--                    <h4 class="mb-4">{{$reviewsCount}} Comments</h4>--}}


{{--                    <div class="">--}}
{{--                        <!-- Comment #1 //-->--}}
{{--                        @foreach($reviews as $review)--}}
{{--                            <div class="py-3">--}}
{{--                                <div class="d-flex comment">--}}

{{--                                    <div class="flex-grow-1 ms-3">--}}
{{--                                        <div class="mb-1 fw-bold link-dark me-1">{{$review->student->name}}--}}
{{--                                            <span class="text-muted text-nowrap">{{$review->created_at}}</span>--}}
{{--                                        </div>--}}
{{--                                        <fieldset class="rating">--}}
{{--                                            @for($i = 0 ;$i<$review->stars;$i++)--}}
{{--                                                <label class="full checked" for="star1"--}}
{{--                                                       title="Sucks big time - 1 star"></label>--}}
{{--                                            @endfor--}}
{{--                                        </fieldset>--}}
{{--                                        <div class="mb-2">{!! nl2br($review->comment) !!}</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        @endforeach--}}


{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
