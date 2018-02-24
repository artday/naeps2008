<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    /**
     * Get all of the owning locatable models.
     */
    public function locatable()
    {
        return $this->morphTo();
    }
}
