<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationResendController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('guest');
    }

    public function showResendForm()
    {
        return view('auth.activate.resend');
    }

    public function resend(Request $request)
    {
        $this->validateResendRequest($request);

        $user = User::byEmail($request->email)->first();

        event(new UserRequestedActivationEmail($user));

        return redirect()->route('login')
            ->with('success','Account activation email has been resent.');
    }

    protected function validateResendRequest(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email|is_false:users,active'
        ], [
            'email.exists' => 'Could not find that account.',
            'email.is_false' => 'This Account already active.'
        ]);
    }
}
