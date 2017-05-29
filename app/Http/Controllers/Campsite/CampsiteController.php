<?php

namespace App\Http\Controllers\Campsite;

use App\User;
use App\Models\Meadow;
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
        $campsites = Campsite::all();
        return view('welcome')->with('campsites', $campsites);
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
        $campsite->province = $campsitedata['province'];
        $campsite->price_is_per_person = $campsitedata['price_is_per_person'];
        $campsite->state = $campsitedata['state'];
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
