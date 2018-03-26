<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Event;
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

    /* Set route Key as login for User model */
    public function getRouteKeyName()
    {
        return 'login';
    }

    /* Activation user */
    public function activate()
    {
        /* Delete reactivation link */
        $this->forget_reactivation_link();
        $this->update(['active' => true,'activation_token' => null]);
        /* Create User Profile */
        $this->profile()->create([]);
    }

    /* Get user login or first name and lst name  if exists */
    public function getNameAttribute()
    {
        if(!$this->profile->first_name){
            return $this->login;
        }
        return trim($this->profile->first_name . ' ' . $this->profile->last_name);
    }

    /* Get user full name if exists */
    public function getFullNameAttribute()
    {
        $fullName= "";
        if($this->profile->first_name){
            $fullName .= $this->profile->first_name;
        }
        if($this->profile->middle_name){
            $fullName .= " ".$this->profile->middle_name;
        }
        if($this->profile->last_name){
            $fullName .= " ".$this->profile->last_name;
        }
        return trim($fullName);
    }

    /* Get user avatar */
    public function getAvatarAttribute()
    {
        return "https://www.gravatar.com/avatar/". md5($this->email) ."?d=mm&s=40";
    }

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

    /**
     * Get user Profile.
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /* The Events where  user is participant. */
    public function events()
    {
        return $this->belongsToMany(
            'App\Models\Event',
            'event_participants',
            'user_id',
            'event_id');
    }

    public function isParticipant(Event $event)
    {
        return (bool)$event->participants()->find($this->id);
    }

    /*
     *
     *
     * */
    public static function reactivationLinkIfNotActive()
    {
        if(request()->session()->has('request_reactivation_link')){
            return;
        }
        $user = self::byEmail(request()->email)->first();
        if($user && !$user->active){
            /* store in session */
            $user->request_reactivation_link();
        }
    }
    public function request_reactivation_link()
    {
        request()->session()->put('request_reactivation_link', 'true');
    }
    public static function forget_reactivation_link()
    {
        request()->session()->forget('request_reactivation_link');
    }
}
