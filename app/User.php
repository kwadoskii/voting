<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function lga()
    {
        return $this->hasOne('App\Lga');
    }

    public function result()
    {
        return $this->belongsTo('App\Result');
    }
}
