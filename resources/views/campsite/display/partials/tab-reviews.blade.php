<div class="row">
    <div class="col-sm-6">
        <h2 class="color-secundary m-b-20">Reviews</h2>
    </div>
</div>
<div class="row">
    @if (!Auth::guest())
        <div class="col-sm-6">
            <form method="POST" action="{{ route('review.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="campsiteid" value="{{ $campsite->id }}">

                <div class="form-group">
                    <div class="form-group{{ $errors->has('review') ? ' has-error' : '' }}">
                        <textarea id="review" type="text" class="form-control" name="review" value="{{ old('review') }}" placeholder="Write a review for this Campsite" ></textarea>

                        @if ($errors->has('review'))
                            <span class="help-block">
                                <strong>{{ $errors->first('review') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secundary pull-right">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    @endif
    <div class="col-sm-6">
        <div class="row">
            @if (count($campsite->reviews))
                @foreach($campsite->reviews as $review)
                    <div class="col-sm-12 m-b-30">
                        <p class="review--date">
                            {{ $review->created_at->format('d/m/y')}}
                        </p>
                        <p class="review--user">
                            <span>{{$review->user->name}}</span>
                        </p>
                        <p class="review--text">
                            {{ $review->review }}
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-sm-12">
                    <p>No reviews yet for this Campsite.</p>
                </div>
            @endif
        </div>
    </div>
</div>
