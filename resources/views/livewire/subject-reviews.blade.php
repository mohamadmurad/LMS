<div>
    <div class="reviews">

        <div class="app container py-4">
            <div class="col-md-12 col-lg-10 m-auto">
                <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                    <!-- New Comment //-->
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <div class="hstack gap-2 mb-1 fw-bold link-dark me-1">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                            </div>
                            <form wire:submit.prevent="submit">
                                <fieldset class="rating">
                                    <input type="radio" wire:model="stars" id="star5" name="rating" value="5"/><label
                                        class="full" for="star5" title="Awesome - 5 stars"><i class="fa fa-star"></i></label>
                                    {{--                                    <input type="radio" wire:model="stars" id="star4half" name="rating"--}}
                                    {{--                                           value="4.5"/><label class="half" for="star4half"--}}
                                    {{--                                                               title="Pretty good - 4.5 stars"></label>--}}
                                    <input type="radio" wire:model="stars" id="star4" name="rating" value="4"/><label
                                        class="full" for="star4" title="Pretty good - 4 stars"><i class="fa fa-star"></i></label>
                                    {{--                                    <input type="radio" wire:model="stars" id="star3half" name="rating"--}}
                                    {{--                                           value="3.5"/><label class="half" for="star3half"--}}
                                    {{--                                                               title="Meh - 3.5 stars"></label>--}}
                                    <input type="radio" wire:model="stars" id="star3" name="rating" value="3"/><label
                                        class="full" for="star3" title="Meh - 3 stars"><i class="fa fa-star"></i></label>
                                    {{--                                    <input type="radio" wire:model="stars" id="star2half" name="rating"--}}
                                    {{--                                           value="2.5"/><label class="half" for="star2half"--}}
                                    {{--                                                               title="Kinda bad - 2.5 stars"></label>--}}
                                    <input type="radio" wire:model="stars" id="star2" name="rating" value="2"/><label
                                        class="full" for="star2" title="Kinda bad - 2 stars"><i class="fa fa-star"></i></label>
                                    {{--                                    <input type="radio" wire:model="stars" id="star1half" name="rating"--}}
                                    {{--                                           value="1.5"/><label class="half" for="star1half"--}}
                                    {{--                                                               title="Meh - 1.5 stars"></label>--}}
                                    <input type="radio" wire:model="stars" id="star1" name="rating" value="1"/><label
                                        class="full" for="star1" title="Sucks big time - 1 star"><i class="fa fa-star"></i></label>
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
                                    <button class="btn btn-sm btn-primary text-uppercase" type="submit">comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3 shadow-sm p-4">

                    <h4 class="mb-4">{{$reviewsCount}} Comments</h4>


                    <div class="">
                        <!-- Comment #1 //-->
                        @foreach($reviews as $review)
                            <div class="py-3">
                                <div class="d-flex comment">

                                    <div class="flex-grow-1 ms-3">
                                        <div class="mb-1 fw-bold link-dark me-1">{{$review->student->name}}
                                            <span class="text-muted text-nowrap">{{$review->created_at}}</span>
                                        </div>
                                        <fieldset class="rating">
                                        @for($i = 0 ;$i<$review->stars;$i++)
                                                <label class="full checked" for="star1" title="Sucks big time - 1 star"></label>
                                        @endfor
                                        </fieldset>
                                        <div class="mb-2">{!! nl2br($review->comment) !!}</div>
                                    </div>
                                </div>

                            </div>
                        @endforeach


                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
