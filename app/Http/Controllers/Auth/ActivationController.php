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

        /* Delete reactivation link */
        $user->forget_reactivation_link($request);

        $user->update([
            'active' => true,
            'activation_token' => null
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('feed')
            ->with('success', 'Activated! You\'re now signed in.');
    }
}
