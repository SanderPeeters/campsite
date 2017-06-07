<?php

namespace App\Http\Controllers\Reservation;

use App\User;
use Carbon\Carbon;
use App\Models\Campsite;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\ReservationRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function showReservationForm($id, $slug=null)
    {
        try {
            $campsite = Campsite::findOrFail($id);

        } catch(ModelNotFoundException $e) {
            return redirect( route('search-campsite') );
        }
        if ($slug !== str_slug($campsite->campsite_name)){
            return redirect(action('Reservation\ReservationController@showReservationForm', ['id' => $campsite->id, 'slug' => str_slug($campsite->campsite_name)]), 301);
        }
        return view('campsite.display.partials.confirm-reservation')->with('campsite', $campsite);
    }

    public function makeReservation(Request $request)
    {
        $reservationdata = $request->get('reservation');

        $reservationvalidator = Validator::make($reservationdata, [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'movement' => 'required',
            'capacity' => 'required|integer'
        ]);

        //If validator fails return object with all rules it failed on.
        if ($reservationvalidator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Validation errors!',
                'errors' => $reservationvalidator->errors()
            );
            return response()->json($returnData, 500);
        }

        $reservation = new Reservation();
        $reservation->user_id = Auth::user()->id;
        $reservation->campsite_id = $reservationdata['campsite_id'];
        $reservation->start_date = Carbon::parse($reservationdata['start_date']);
        $reservation->end_date = Carbon::parse($reservationdata['end_date']);
        $reservation->capacity = $reservationdata['capacity'];
        $reservation->movement_id = $reservationdata['movement'];
        if(isset($reservationdata['extra_info'])){
            $reservation->extra_info = $reservationdata['extra_info'];
        }
        $reservation->save();

        $returnData = array(
            'status' => 'Succes',
            'message' => 'Reservation successfully made!'
        );

        $admin = New User();
        $admin->email = config('app.adminmainemail');

        Notification::send($admin, new ReservationRequest($reservation));

        return response()->json($returnData, 200);
    }
}
