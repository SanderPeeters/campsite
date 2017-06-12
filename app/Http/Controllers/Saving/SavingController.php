<?php

namespace App\Http\Controllers\Saving;

use App\Models\Saving;
use App\Models\Campsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SavingController extends Controller
{
    public function statusSaveCampsite (Request $request)
    {
        if ($saving = Saving::where([['user_id', Auth::user()->id], ['campsite_id', $request->get('campsiteid')]])->first())
        {
            $saving->delete();
            return 0;
        } else {
            $saving = new Saving();
            $saving->campsite_id = $request->get('campsiteid');
            $saving->user_id = Auth::user()->id;
            $saving->save();
            return 1;
        }
    }
}
