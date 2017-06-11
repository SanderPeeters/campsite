<?php

namespace App\Http\Controllers\Search;

use App\Models\Province;
use App\Models\Campsite;
use App\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function index ()
    {
        return view('campsite.search.campsite-search');
    }

    public function searchOnProvince(Request $request, $id)
    {
        $campsites = Campsite::where('province_id', $id)->with('campimages')->with('province')->with('state')->with('user.movement')->latest()->get();
        $campsites = $campsites->groupBy('campsite_name');
        $province = Province::find($id);
        $province->name = trans('provinces.'.$id);
        app('App\Http\Controllers\Campsite\CampsiteController')->collectCampsites($campsites);
        $campsites->put('province', $province);
        $campsites = ( new Collection( $campsites ) )->paginate( 5 );
        return $campsites;
    }

    public function searchCampsites(Request $request)
    {
        $query = Campsite::select();

        if ($request->get('campsite_name')){
            $query->where('campsite_name', 'like', '%'.$request->get('campsite_name').'%');
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
                        }
                    }
                });
            }
        }
        if ($request->get('provinces')) {
            $query->whereIn('province_id',array_pluck(json_decode($request->get('provinces'), true), 'id'));
        }
        if ($request->get('states')) {
            $query->whereIn('state_id',array_pluck(json_decode($request->get('states'), true), 'id'));
        }

        $campsites = $query->with('campimages')->with('user.movement')->latest()->get();

        foreach ($campsites as $campsite)
        {
            $campsite->province->name = trans('provinces.'.$campsite->province->id);
            $campsite->state->name = trans('states.'.$campsite->state->id);
        }
        $campsites = $campsites->groupBy('campsite_name');

        app('App\Http\Controllers\Campsite\CampsiteController')->collectCampsites($campsites);

        if ($request->get('capacity_slider')){
            foreach ($campsites as $value => $campsite)
            {
                if ($campsite['totalcapacity'] <= json_decode($request->capacity_slider)->minValue ||  json_decode($request->capacity_slider)->maxValue <= $campsite['totalcapacity'])
                {
                    $campsites->forget($value);
                }
            }
        }

        return $campsites;
    }
}
