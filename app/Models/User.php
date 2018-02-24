<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'active', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];





    public function scopeByActivationColumns(Builder $builder, $email, $token)
    {
        return $builder->where('email', $email)->where('activation_token', $token);
    }

    public function scopeByEmail(Builder $builder, $email)
    {
        return $builder->where('email', $email);
    }

    /**
     * Get user location.
     */
    public function location()
    {
        return $this->morphMany('App\Models\Location', 'locatable');
    }

    /**
     * Get user Birthday.
     */
    public function birthday()
    {
        return $this->morphMany('App\Models\Date', 'datable');
    }


    public function isParticipant(Event $event)
    {

    }


    /*
     *
     *
     * */
    public static function reactivationLinkIfNotActive(Request $request)
    {
        if($request->session()->has('request_reactivation_link')){
            return;
        }
        $user = self::byEmail($request->email)->first();
        if($user && !$user->active){
            /* store in session */
            $user->request_reactivation_link($request);
        }
    }
    /*
     *
     * */
    public function request_reactivation_link(Request $request)
    {
        $request->session()->put('request_reactivation_link', 'true');
    }
    /*
     *
     * */
    public static function forget_reactivation_link(Request $request)
    {
        $request->session()->forget('request_reactivation_link');
    }
}
