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

    public function index()
    {
        $campsites = $this->getAllCampsites();
        return view('welcome')->with('campsites', $campsites);
    }

    public function indexOfferCampsite()
    {
        if (Auth::user())
        {
            if(Auth::user()->campsite)
            {
                return view('campsite.offer.my-campsite')->with('campsite', Auth::user()->campsite);

            } else {
                $campsites = $this->getAllCampsites();
                return view('campsite.offer.campsite-offer')->with('campsites', $campsites);
            }
        } else {
            $campsites = $this->getAllCampsites();
            return view('campsite.offer.campsite-offer')->with('campsites', $campsites);
        }
    }

    public function getAllCampsites()
    {
        $campsites = Campsite::with('campimages')->with('province')->with('state')->with('user.movement')->latest()->get();
        $campsites = $campsites->groupBy('campsite_name');

        $campsites = $this->collectCampsites($campsites);
        return $campsites;
    }

    public function collectCampsites($campsites)
    {
        foreach ($campsites as $name => $campsite) {
            $buildings = Building::where('campsite_id', $campsite[0]->id)->get();
            $meadows = Meadow::where('campsite_id', $campsite[0]->id)->get();

            $campsite[0]->province->name = trans('provinces.'.$campsite[0]->province->id);
            $campsite[0]->state->name = trans('states.'.$campsite[0]->state->id);

            $totalcapacity = 0;
            $haswifi = false;
            $haskitchen = false;
            $haswater = false;
            $haselectricity = false;
            $campfiresallowed = false;
            $tentsallowed = false;
            $wheelchairaccessible = false;

            foreach ($buildings as $building) {
                if ($building->has_wifi)
                {
                    $haswifi = true;
                }
                if ($building->has_kitchen)
                {
                    $haskitchen = true;
                }
                if ($building->has_water)
                {
                    $haswater = true;
                }
                if ($building->has_electricity)
                {
                    $haselectricity = true;
                }
                if ($building->wheelchair_accessible)
                {
                    $wheelchairaccessible = true;
                }

                $totalcapacity += $building->capacity;
            }
            foreach ($meadows as $meadow) {
                $totalcapacity += $meadow->capacity;
                if ($meadow->tents_allowed)
                {
                    $tentsallowed = true;
                }
                if ($meadow->campfire_allowed)
                {
                    $campfiresallowed = true;
                }
                if ($meadow->has_water)
                {
                    $haswater = true;
                }
                if ($meadow->has_electricity)
                {
                    $haselectricity = true;
                }
            }
            $campsite->put('tentsallowed', $tentsallowed);
            $campsite->put('campfireallowed', $campfiresallowed);
            $campsite->put('wheelchairaccessible', $wheelchairaccessible);
            $campsite->put('haswifi', $haswifi);
            $campsite->put('haskitchen', $haskitchen);
            $campsite->put('haswater', $haswater);
            $campsite->put('haselectricity', $haselectricity);
            $campsite->put('totalcapacity', $totalcapacity);
            $campsite->put('buildings', $buildings);
            $campsite->put('meadows', $meadows);
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
        $saved = 0;
        try {
            $campsite = Campsite::with('campimages')->with('reviews')->with('reservations.user')->findOrFail($id);

        } catch(ModelNotFoundException $e) {
            return redirect( route('search-campsite') );
        }
        if ($slug !== str_slug($campsite->campsite_name)){
            return redirect(action('Campsite\CampsiteController@showCampsite', ['id' => $campsite->id, 'slug' => str_slug($campsite->campsite_name)]), 301);
        }
        if (Auth::user())
        {
            if (Auth::user()->savings()->where('campsite_id', $id)->first())
            {
                $saved = 1;
            } else {
                $saved = 0;
            }
        }
        return view('campsite.display.show-campsite')->with('campsite', $campsite)->with('saved', $saved);
    }

    public function storeCampsite (Request $request)
    {
        $campsitedata = $request->get('campsite');
        $images = $request->get('images');
        $buildings = $request->get('buildings');
        $meadows = $request->get('meadows');

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
        $campsite->latitude = $campsitedata['latitude'];
        $campsite->longitude = $campsitedata['longitude'];
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
                if(isset($building['wheelchairaccessible'])){
                    $newbuilding->wheelchair_accessible = $building['wheelchairaccessible'];
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

                if (isset($meadow['capacity'])) {
                    $newmeadow->capacity = $meadow['capacity'];
                }
                if (isset($meadow['sqmeters'])) {
                    $newmeadow->sq_meters = $meadow['sqmeters'];
                }
                if (isset($meadow['haswater'])) {
                    $newmeadow->has_water = $meadow['haswater'];
                }
                if (isset($meadow['haselectricity'])) {
                    $newmeadow->has_electricity = $meadow['haselectricity'];
                }
                if (isset($meadow['campfiresallowed'])) {
                    $newmeadow->campfire_allowed = $meadow['campfireallowed'];
                }
                if (isset($meadow['tentsallowed'])) {
                    $newmeadow->tents_allowed = $meadow['tentsallowed'];
                }
                if (isset($meadow['extrainfo'])) {
                    $newmeadow->extra_info = $meadow['extrainfo'];
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

    public function updateCampsite (Request $request)
    {
        $this->validate($request, [
            'campsitename'  =>  'required',
            'price'         =>  'required|integer',
            'description'   =>  'required',
            'website'       =>  'required|url'
        ]);

        $campsite = Campsite::find($request->get('campsiteid'));
        $campsite->campsite_name = $request->get('campsitename');
        $campsite->price_per_night = $request->get('price');
        $campsite->description = $request->get('description');
        $campsite->website = $request->get('website');
        $campsite->save();
        return redirect()->back()->with('success_message', 'You\'re Campsite was successfully updated!');
    }

    public function addBuilding(Request $request)
    {
        $this->validate($request, [
            'building_capacity'  =>  'required|integer',
            'building_beds'      =>  'required|integer',
            'building_showers'   =>  'required|integer',
            'building_toilets'   =>  'required|integer'
        ]);
        $building = new Building();
        $building->campsite_id = $request->get('campsiteid');
        if($request->get('building_capacity') || $request->get('building_capacity') == 0)
        {
            $building->capacity = $request->get('building_capacity');
        }
        if($request->get('building_beds') || $request->get('building_beds') == 0)
        {
            $building->beds = $request->get('building_beds');
        }
        if($request->get('building_showers') || $request->get('building_showers') == 0)
        {
            $building->showers = $request->get('building_showers');
        }
        if($request->get('building_toilets') || $request->get('building_toilets') == 0)
        {
            $building->toilets = $request->get('building_toilets');
        }
        if($request->get('building_haswater'))
        {
            $building->has_water = $request->get('building_haswater');
        }
        if($request->get('building_haselectricity'))
        {
            $building->has_electricity = $request->get('building_haselectricity');
        }
        if($request->get('building_haswifi'))
        {
            $building->has_wifi = $request->get('building_haswifi');
        }
        if($request->get('building_haskitchen'))
        {
            $building->has_kitchen = $request->get('building_haskitchen');
        }
        if($request->get('building_wheelchairaccessible'))
        {
            $building->wheelchair_accessible = $request->get('building_wheelchairaccessible');
        }
        if($request->get('building_extrainfo'))
        {
            $building->extra_info = $request->get('building_extrainfo');
        }

        $building->save();
        return redirect()->back()->with('success_message', 'You\'re building was successfully added to your Campsite!');
    }

    public function addMeadow(Request $request)
    {
        $this->validate($request, [
            'meadow_capacity'  =>  'required|integer',
            'meadow_sqmeters'  =>  'required|integer',
        ]);
        $meadow = new Meadow();
        $meadow->campsite_id = $request->get('campsiteid');
        if($request->get('meadow_capacity') || $request->get('meadow_capacity') == 0)
        {
            $meadow->capacity = $request->get('meadow_capacity');
        }
        if($request->get('meadow_sqmeters') || $request->get('meadow_sqmeters') == 0)
        {
            $meadow->sq_meters = $request->get('meadow_sqmeters');
        }
        if($request->get('meadow_haselectricity'))
        {
            $meadow->has_electricity = $request->get('meadow_haselectricity');
        }
        if($request->get('meadow_haswater'))
        {
            $meadow->has_water = $request->get('meadow_haswater');
        }
        if($request->get('meadow_tentsallowed'))
        {
            $meadow->tents_allowed = $request->get('meadow_tentsallowed');
        }
        if($request->get('meadow_campfireallowed'))
        {
            $meadow->campfire_allowed = $request->get('meadow_campfireallowed');
        }
        if($request->get('meadow_extrainfo'))
        {
            $meadow->extra_info = $request->get('meadow_extrainfo');
        }

        $meadow->save();
        return redirect()->back()->with('success_message', 'You\'re meadow was successfully added to your Campsite!');
    }

    public function deleteBuilding($id)
    {
        $building = Building::find($id);
        $building->delete();
        return redirect()->back()->with('success_message', 'You\'re building was successfully deleted!');
    }

    public function deleteMeadow($id)
    {
        $meadow = Meadow::find($id);
        $meadow->delete();
        return redirect()->back()->with('success_message', 'You\'re meadow was successfully deleted!');

    }
}
