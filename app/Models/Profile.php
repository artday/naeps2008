<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'tel'];



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
