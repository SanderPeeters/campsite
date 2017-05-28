<?php

namespace App\Http\Controllers\Campsite;

use App\User;
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
        $campsite->state = $campsitedata['state'];
        $campsite->latitude = number_format($campsitedata['latitude'], 8);
        $campsite->longitude = number_format($campsitedata['longitude'], 8);
        $campsite->description = $campsitedata['description'];
        $campsite->price_per_night = $campsitedata['price'];
        $campsite->website = $campsitedata['website'];
        $campsite->user_id = Auth::user()->id;
        $campsite->save();

        foreach ($buildings as $building) {
            $newbuilding = new Building();
            $newbuilding->campsite_id = $campsite->id;
            $newbuilding->capacity = $building['capacity'];
            $newbuilding->beds = $building['beds'];
            $newbuilding->showers = $building['showers'];
            $newbuilding->toilets = $building['toilets'];
            $newbuilding->has_water = $building['haswater'];
            $newbuilding->has_electricity = $building['haselectricity'];
            $newbuilding->has_wifi = $building['haswifi'];
            $newbuilding->has_kitchen = $building['haskitchen'];
            $newbuilding->extra_info = $building['extrainfo'];

            /*if(isset($building['capacity'])){
                $newbuilding->capacity = $building->capacity;
            }
            if(isset($building['beds'])){
                $newbuilding->beds = $building->beds;
            }
            if(isset($building['showers'])){
                $newbuilding->showers = $building->showers;
            }
            if(isset($building['toilets'])){
                $newbuilding->toilets = $building->toilets;
            }
            if(isset($building['haswater'])){
                $newbuilding->has_water = $building->has_water;
            }
            if(isset($building['haselectricity'])){
                $newbuilding->has_electricity = $building->has_electricity;
            }
            if(isset($building['haswifi'])){
                $newbuilding->has_wifi = $building->has_wifi;
            }
            if(isset($building['haskitchen'])){
                $newbuilding->has_kitchen = $building->has_kitchen;
            }
            if(isset($building['extrainfo'])){
                $newbuilding->has_kitchen = $building->has_kitchen;
            }*/

            $newbuilding->save();
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
