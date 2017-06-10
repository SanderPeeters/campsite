<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'movement_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function campsite ()
    {
        return $this->hasOne('App\Models\Campsite');
    }

    public function reservations ()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function movement()
    {
        return $this->belongsTo('App\Models\Movement');
    }

    public function reviews ()
    {
        return $this->hasMany('App\Models\Review');
    }
}
