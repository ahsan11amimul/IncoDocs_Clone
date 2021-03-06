<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $guarded=[];
    public function users()
    {
        return $this->hasMany('App\User::class');
    }
}
