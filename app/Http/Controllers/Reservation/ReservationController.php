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
        if ($request->start_date)
        {
            $request->start_date = Carbon::parse($request->start_date);
        }
        if ($request->end_date)
        {
            $request->end_date = Carbon::parse($request->end_date);
        }

        $this->validate($request, [
            'start_date'    =>  'required|date',
            'end_date'      =>  'required|date|after:start_date',
            'movement'      =>  'required',
            'capacity'      =>  'required|integer'
        ]);

        $reservation = new Reservation();
        $reservation->user_id = Auth::user()->id;
        $reservation->campsite_id = $request->get('campsite_id');
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
        $reservation->capacity = $request->get('capacity');
        $reservation->movement_id = $request->get('movement');
        if($request->get('extrainfo'))
        {
            $reservation->extra_info = $request->get('extrainfo');
        }
        $reservation->save();

        $campsiteuser = new User();
        $campsiteuser->email = $reservation->campsite->user->email;

        Notification::send($campsiteuser, new ReservationRequest($reservation));

        return redirect()->back()->with('success_message', trans('reservation.success'));
    }
}
