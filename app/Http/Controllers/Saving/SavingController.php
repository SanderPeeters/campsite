<?php

namespace App\Http\Controllers\Saving;

use App\Models\Campsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SavingController extends Controller
{
    public function statusSaveCampsite (Request $request)
    {
        if (Auth::user()->savings()->where('campsite_id', $request->get('campsiteid'))->first())
        {
            Auth::user()->savings()->detach($request->get('campsiteid'));
            return 0;
        } else {
            Auth::user()->savings()->attach($request->get('campsiteid'));
            return 1;
        }
    }
}
