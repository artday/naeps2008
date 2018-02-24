<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $table = 'event_participants';

    protected $fillable = [
        'user_id', 'event_id'
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }
}
