<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }

    public function offices()
    {
        return $this->hasMany('App\Office');
    }

    public function voter()
    {
        return $this->hasMany('App\User');
    }

    public function states()
    {
        return $this->hasMany('App\State');
    }

    public function parties()
    {
        return $this->hasMany('App\Party');
    }

    public function lgas()
    {
        return $this->hasMany('App\Lga');
    }

    public function constituencies()
    {
        return $this->hasMany('App\Constituency');
    }

    protected $fillable = [
        'office_id', 'candi_id', 'lga_id', 'consti_id', 'state_id', 'user_id',
    ];
}
