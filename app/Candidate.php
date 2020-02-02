<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function party()
    {
        return $this->belongsTo('App\Party');
    }

    public function office()
    {
        return $this->belongsTo('App\Office');
    }

    public function constituency()
    {
        return $this->belongsTo('App\Constituency');
    }

    public function result()
    {
        return $this->belongsTo('App\Result');
    }
}
