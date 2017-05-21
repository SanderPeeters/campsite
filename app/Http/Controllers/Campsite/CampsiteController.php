<?php

namespace App\Http\Controllers\Campsite;

use App\User;
use App\Models\Campsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampsiteController extends Controller
{
    public function storeCampsite (Request $request)
    {
        return $request->all();
    }
}
