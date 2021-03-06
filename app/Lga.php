<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function constituency()
    {
        return $this->belongsTo('App\Constituency');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    // public function voter()
    // {
    //     return $this->belongsTo('App\Voter');
    // }
}
