<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function activate(Request $request)
    {
        $user = User::byActivationColumns($request->email, $request->token)->firstOrFail();

        /* Activate user */
        $user->activate();


        /*$user->update([
            'active' => true,
            'activation_token' => null
        ]);*/



        /* Log User in by id */
        Auth::loginUsingId($user->id);

        /* Redirecting User */
        return redirect()->route('feed')
            ->with('success', 'Activated! You\'re now signed in.');
    }
}
