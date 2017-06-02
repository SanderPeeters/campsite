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
        if ($buildings = json_decode($request->get('hasbuilding'))) {
            $query->has('buildings');
            if ($options = json_decode($request->get('buildingoptions')))
            {
                $query->whereHas('buildings', function ($query) use ($options) {
                    foreach ($options as $option => $value){
                        if ($value) {
                            $query->where($option, $value);
                        }
                    }
                });
            }
        }
        if ($meadows = json_decode($request->get('hasmeadow'))) {
            $query->has('meadows');
            if ($options = json_decode($request->get('meadowoptions')))
            {
                $query->whereHas('meadows', function ($query) use ($options) {
                    foreach ($options as $option => $value){
                        if ($value) {
                            $query->where($option, $value);
                        }                    }
                });
            }
        }


        $campsites = $query->with('campimages')->latest()->paginate($this->paginatenumber);

        foreach ($campsites as $campsite)
        {
            $campsite->province->name = trans('provinces.'.$campsite->province->id);
        }

        return $campsites;
    }
}
