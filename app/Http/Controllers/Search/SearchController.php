<?php

namespace App\Http\Controllers\Search;

use App\Models\Campsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index ()
    {
        $campsites = $this->getAllCampsites();
        return view('campsite.search.campsite-search')->with('campsites', $campsites);
    }
    public function getAllCampsites ()
    {
        $campsites = Campsite::all();
        return $campsites;
    }
}
