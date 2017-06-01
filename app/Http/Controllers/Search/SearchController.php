<?php

namespace App\Http\Controllers\Search;

use App\Models\Campsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index ()
    {
        return view('campsite.search.campsite-search');
    }

    public function searchCampsites(Request $request)
    {

    }
}
