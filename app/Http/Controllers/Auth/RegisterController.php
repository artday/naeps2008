<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|max:25',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:7|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => false,
            'activation_token' => str_random(100),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        /* show resend activation link */
        $user->request_reactivation_link($request);

        /* send activation link message */
        event(new UserRequestedActivationEmail($user));

        return redirect($this->redirectPath())
            ->with('success', 'Registered. Please check your email to activate your account.');
    }
}
