<?php

namespace App\Http\Controllers\Search;

use App\Models\Campsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    private $paginatenumber = 25;

    public function index ()
    {
        return view('campsite.search.campsite-search');
    }

    public function searchCampsites(Request $request)
    {
        $query = Campsite::select();

        if ($request->get('campsite_name')){
            $query->where('campsite_name', 'like', '%'.$request->get('campsite_name').'%');
        }
        if ($request->get('capacity_slider')){
            $query->whereHas('buildings', function ($query) use ($request) {
                $query->whereBetween('capacity', [json_decode($request->capacity_slider)->minValue, json_decode($request->capacity_slider)->maxValue]);
            });
        }
        if ($request->get('price_slider')){
            $query->whereBetween('price_per_night', [json_decode($request->price_slider)->minValue, json_decode($request->price_slider)->maxValue]);
        }
        if ($buildings = json_decode($request->get('facilities'))->building) {
            $query->has('buildings');
        }
        if ($meadows = json_decode($request->get('facilities'))->meadow) {
            $query->has('meadows');
        }

        $campsites = $query->with('campimages')->latest()->paginate($this->paginatenumber);

        return $campsites;
    }
}
