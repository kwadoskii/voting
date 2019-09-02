<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    public function lgas()
    {
        return $this->hasMany('App\Lga');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
