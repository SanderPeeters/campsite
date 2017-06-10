<?php

namespace App\Http\Controllers\Review;

use App\User;
use App\Models\Review;
use App\Models\Campsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        $this->validate($request, [
            'review'    =>  'required'
        ]);

        $review = new Review();
        $review->review = $request->get('review');
        $review->campsite_id = $request->get('campsiteid');
        $review->user_id = Auth::user()->id;
        $review->save();
        return redirect()->back();
    }
}
