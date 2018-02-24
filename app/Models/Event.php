<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
//    protected $fillable = [];


    /**
     * Get Event location.
     */
    public function location()
    {
        return $this->getLocation()->first()->location;
    }

    /**
     * Get Event's date.
     */
    public function date()
    {
        $date = Carbon::parse($this->getDate()->first()->date);
        return $date->format('d.m.Y');
    }

//    public function getAParticipants()    {
//
//        return $this->participants()->where('event_id', $this->id);
//    }

    /**
     * Morph to location.
     */
    public function getLocation()
    {
        return $this->morphMany('App\Models\Location', 'locatable');
    }

    /**
     * Morph to date.
     */
    public function getDate()
    {
        return $this->morphMany('App\Models\Date', 'datable');
    }

    public function participants()
    {
        return $this->hasMany('App\Models\EventParticipant');
    }
}
