<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }

    public function result()
    {
        return $this->belongsTo('App\Result');
    }
}
