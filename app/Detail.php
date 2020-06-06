<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    //
    protected $guarded=[];
     public function users()
    {
        return $this->hsMany('App\User::class');
    }
}
