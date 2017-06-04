<?php

namespace App\Http\Controllers\Campsite;

use App\User;
use App\Models\State;
use App\Models\Meadow;
use App\Models\Province;
use App\Models\Building;
use App\Models\Campsite;
use App\Models\Campimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampsiteController extends Controller
{
    private $paginatenumber = 25;

    public function index()
    {
        $campsites = $this->getAllCampsites();
        return view('welcome')->with('campsites', $campsites);
    }

    public function indexOfferCampsite()
    {
        $campsites = $this->getAllCampsites();
        return view('campsite.offer.campsite-offer')->with('campsites', $campsites);
    }

    public function getAllCampsites()
    {
        $campsites = Campsite::with('campimages')->with('province')->with('state')->latest()->paginate($this->paginatenumber);
        foreach ($campsites as $campsite)
        {
            $campsite->province->name = trans('provinces.'.$campsite->province->id);
            $campsite->state->name = trans('states.'.$campsite->state->id);
        }
        return $campsites;
    }

    public function getAllProvinces()
    {
        $provinces = Province::orderBy('name')->get();
        foreach ($provinces as $province)
        {
            $province->name = trans('provinces.'.$province->id);
        }
        return $provinces;
    }

    public function getAllStates()
    {
        $states = State::orderBy('name')->get();
        foreach ($states as $state)
        {
            $state->name = trans('states.'.$state->id);
        }
        return $states;
    }

    public function showCampsite($id, $slug=null)
    {
        try {
            $campsite = Campsite::with('campimages')->findOrFail($id);

        } catch(ModelNotFoundException $e) {
            return redirect( route('search-campsite') );
        }
        if ($slug !== str_slug($campsite->campsite_name)){
            return redirect(action('Campsite\CampsiteController@showCampsite', ['id' => $campsite->id, 'slug' => str_slug($campsite->campsite_name)]), 301);
        }
        return view('campsite.display.show-campsite')->with('campsite', $campsite);
    }

    public function storeCampsite (Request $request)
    {
        $campsitedata = $request->get('campsite');
        $images = $request->get('images');
        $buildings = $request->get('buildings');
        $meadows = $request->get('meadowse');

        $campsitevalidator = Validator::make($campsitedata, [
            'placename' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'website' => 'url'
        ]);

        //If validator fails return object with all rules it failed on.
        if ($campsitevalidator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Validation errors!',
                'errors' => $campsitevalidator->errors()
            );
            return response()->json($returnData, 500);
        }

        $campsite = new Campsite();
        $campsite->campsite_name = $campsitedata['placename'];
        $campsite->street = $campsitedata['street'].' '.$campsitedata['street_number'];
        $campsite->city = $campsitedata['city'];
        $campsite->zipcode = $campsitedata['zipcode'];
        $campsite->province_id = $campsitedata['province'];
        $campsite->state_id = $campsitedata['state'];
        $campsite->latitude = number_format($campsitedata['latitude'], 8);
        $campsite->longitude = number_format($campsitedata['longitude'], 8);
        $campsite->description = $campsitedata['description'];
        $campsite->price_per_night = $campsitedata['price'];
        $campsite->website = $campsitedata['website'];
        $campsite->user_id = Auth::user()->id;
        $campsite->save();

        if (isset($buildings)) {
            foreach ($buildings as $building) {
                $newbuilding = new Building();
                $newbuilding->campsite_id = $campsite->id;

                if(isset($building['capacity'])){
                    $newbuilding->capacity = $building['capacity'];
                }
                if(isset($building['beds'])){
                    $newbuilding->beds = $building['beds'];
                }
                if(isset($building['showers'])){
                    $newbuilding->showers = $building['showers'];
                }
                if(isset($building['toilets'])){
                    $newbuilding->toilets = $building['toilets'];
                }
                if(isset($building['haswater'])){
                    $newbuilding->has_water = $building['haswater'];
                }
                if(isset($building['haselectricity'])){
                    $newbuilding->has_electricity = $building['haselectricity'];
                }
                if(isset($building['haswifi'])){
                    $newbuilding->has_wifi = $building['haswifi'];
                }
                if(isset($building['haskitchen'])){
                    $newbuilding->has_kitchen = $building['haskitchen'];
                }
                if(isset($building['extrainfo'])){
                    $newbuilding->extra_info = $building['extrainfo'];
                }

                $newbuilding->save();
            }
        }

        if (isset($meadows)) {
            foreach ($meadows as $meadow) {
                $newmeadow = new Meadow();
                $newmeadow->campsite_id = $campsite->id;

                if (isset($building['capacity'])) {
                    $newmeadow->capacity = $meadow['capacity'];
                }
                if (isset($building['sqmeters'])) {
                    $newmeadow->beds = $building['beds'];
                }
                if (isset($building['haswater'])) {
                    $newmeadow->has_water = $building['haswater'];
                }
                if (isset($building['haselectricity'])) {
                    $newmeadow->has_electricity = $building['haselectricity'];
                }
                if (isset($building['campfiresallowed'])) {
                    $newmeadow->campfire_allowed = $building['campfireallowed'];
                }
                if (isset($building['tentsallowed'])) {
                    $newmeadow->tents_allowed = $building['tentsallowed'];
                }
                if (isset($building['extrainfo'])) {
                    $newmeadow->extra_info = $building['extrainfo'];
                }

                $newmeadow->save();
            }
        }

        foreach ($images as $image) {
            if ($image && $image != null){
                $campimage = Campimage::where('identifier', $image)->firstOrFail();
                if ($campimage->count()){
                    $campimage->campsite_id = $campsite->id;
                    $campimage->save();
                }
            }
        }

        $returnData = array(
            'status' => 'Succes',
            'message' => 'Campsite successfully added to database!'
        );
        return response()->json($returnData, 200);
    }
}
