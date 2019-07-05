<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function lgas()
    {
        return $this->hasMany('App\Lga');
    }

    public function constituencies()
    {
        return $this->hasMany('App\Constituency');
    }

    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }
}
