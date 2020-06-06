<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $guarded=[];
     public function users()
    {
        return $this->hsMany('App\User::class');
    }
}
