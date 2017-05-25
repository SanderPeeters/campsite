<?php

namespace App\Http\Controllers\Campsite;

use App\Models\Campsite;
use App\Models\Campimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function saveImage(Request $request)
    {
        $postData = $request->only('file');
        $file = $postData['file'];

        //Validator needs array
        $fileArray = array('imagetosave' => $file);

        $rules = array(
            'imagetosave' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        //create custom message for validators
        $messages = [
            'imagetosave.max' => 'De afbeelding mag niet groter zijn dan 10 megabytes.',
        ];

        $validator = Validator::make($fileArray, $rules, $messages);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }

        else {

            $filename  = time().str_random(30).'.' . $file->getClientOriginalExtension();
            Storage::putFileAs('img/campsites/', $file, $filename);

            $image = new Campimage();

            //Check that identifier token of image is really unique so there is no clashing
            do
            {
                $uniquetoken = str_random(50);
                $image_code = Campimage::where('identifier', $uniquetoken)->first();
            }
            while(!empty($image_code));

            $image->identifier = $uniquetoken;
            $image->filename = $filename;
            $image->save();
            //return image with identifier so that the car can later be linked to images
            return $image;
        }
    }
}
