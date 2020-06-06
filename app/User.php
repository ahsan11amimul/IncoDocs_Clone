<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function company()
    {
       return $this->hasOne('App\Company::class');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
     public function products()
    {
        return $this->hasMany('App\Product');
    }
     public function details()
    {
        return $this->hasMany('App\Detail');
    }
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
