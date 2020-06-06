<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $guarded=[];
     public function invoice()
    {
        return $this->belongTo('App\Invoice::class');
    }
}
