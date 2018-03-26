<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
        if(!$user->login){
            $user = Auth::user();
        }
        return view('profile.index')
            ->with('user', $user);
    }

    public function getUpdate()
    {
        return view('profile.update')
            ->with('user', Auth::user());
    }

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string|alpha_dash|max:25|unique_except_id:users,'.Auth::user()->id,
            'first_name' => 'required|string|alpha|max:50',
            'middle_name' => 'required|string|alpha|max:50',
            'last_name' => 'required|string|alpha|max:50',
            'tel' => 'regex:/^((\+380)+([0-9]){9})$/m'
        ]);

        Auth::user()->update([
            'login' => $request->input('login'),
        ]);

        Auth::user()->profile->update([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'tel' => $request->input('tel')
        ]);

        return redirect()->route('profile')->with('success', 'Your Profile has been updated');

    }

    public function people()
    {
        $people = User::all();
        return view('profile.people')->with('people', $people);
    }

}
