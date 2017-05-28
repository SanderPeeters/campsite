<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campsite extends Model
{
    protected $fillable = ['campsite_name', 'website', 'price_per_night',
        'description', 'latitude', 'longitude', 'city', 'zipcode', 'street', 'state', 'province'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function campimages() {
        return $this->hasMany('App\Models\Campimage');
    }

    public function buildings() {
        return $this->hasMany('App\Models\Building');
    }

    public function meadows() {
        return $this->hasMany('App\Models\Meadow');
    }
}
