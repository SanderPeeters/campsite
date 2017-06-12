<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function myProfile ()
    {
        return view('profile.my-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'movement_id' => 'required',
            'email' => [
                'required','email','max:255', Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->movement_id = $request->get('movement_id');
        $user->save();

        return redirect()->route('my-profile')->with('success_message', 'Profile was successfully changed!');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',

        ]);

        $user = Auth::user();

        if(!Hash::check($request['old_password'], $user->password)){
            return back()->withErrors([
                'old_password' => 'Your previous password is wrong!',
            ]);

        }

        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect()->route('my-profile')->with('success_message', 'Password was successfully changed!');
    }
}
