<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $table = 'dates';

    protected $dates = [
        'date'
    ];


    /**
     * Get all of the owning datable models.
     */
    public function datable()
    {
        return $this->morphTo();
    }


}
