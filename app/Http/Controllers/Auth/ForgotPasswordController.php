<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validate the email for the given request.
     *
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        /* Show resend activation link if email isset and user( who trying to login ) not active */
        User::reactivationLinkIfNotActive($request);

        $this->validate($request, [
            'email' => [
                'required',
                'email',
                'string',
                'exists:users,email',
                'is_true:users,active'
            ]
        ],[
            'email.is_true' => 'You need to activate your account.'
        ]);

        /* Delete activation link if logged in */
        User::forget_reactivation_link($request);
    }

}
