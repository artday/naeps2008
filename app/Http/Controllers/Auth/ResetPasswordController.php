<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules($request), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function rules(Request $request)
    {
        User::reactivationLinkIfNotActive($request);
        return [
            'token' => 'required',
            'password' => 'bail|required|confirmed|min:7',
            'email' => 'bail|required|email|exists:users,email|is_true:users,active',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'email.exists' => "There is no user with that email.",
            'email.is_true' => "You must activate your account first."
        ];
    }

    protected function resetPassword($user, $password)
    {
        if($user->active){
            $user->forceFill([
                'password' => bcrypt($password),
                'remember_token' => Str::random(60),
            ])->save();
            $this->guard()->login($user);
        }
        return redirect($this->redirectPath())->with('warning', 'You must activate your account first.');
    }

    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
            ->with('success','Your password has been reset successfully.');
    }
}
