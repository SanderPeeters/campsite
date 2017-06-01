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

        $campsites = $query->with('campimages')->latest()->paginate($this->paginatenumber);

        return $campsites;
    }
}
