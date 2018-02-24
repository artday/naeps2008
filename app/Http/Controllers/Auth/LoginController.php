<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/feed';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        /* Show reactivation link if email owner is not active */
        User::reactivationLinkIfNotActive($request);

        $this->validate($request, [
            $this->username() => [
                'required',
                'email',
                'string',
                'exists:users,email',
                'is_true:users,active' // Custom validation in ServiceProvider
            ],
            'password' => 'required|string',
        ], $this->validationErrors());
    }

    protected function validationErrors()
    {
        return [
            $this->username() . '.is_true' => 'You need to activate your account.',
            $this->username() . '.exists' => 'There is no user with that email.'
        ];
    }

    protected function authenticated(Request $request, $user)
    {
        /* Delete activation link if logged in */
        $user->forget_reactivation_link($request);
    }
}
