<?php

namespace App\Http\Controllers\Campsite;

use App\User;
use App\Models\Campsite;
use App\Models\Campimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampsiteController extends Controller
{
    public function storeCampsite (Request $request)
    {
        $campsitedata = $request->get('campsite');
        $images = $request->get('images');

        $campsitevalidator = Validator::make($campsitedata, [
            'placename' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required|integer'
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
        $campsite->address = $campsitedata['address'];
        $campsite->latitude = number_format($campsitedata['latitude'], 8);
        $campsite->longitude = number_format($campsitedata['longitude'], 8);
        $campsite->description = $campsitedata['description'];
        $campsite->price_per_night = $campsitedata['price'];
        $campsite->user_id = Auth::user()->id;
        $campsite->save();

        foreach ($images as $image){
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
