<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meadow extends Model
{
    protected $fillable = ['campsite_id', 'capacity', 'has_water',
        'has_electricity', 'campfire_allowed', 'tents_allowed', 'sq_meters'];

    public function campsite () {
        return $this->belongsTo('App\Campsite');
    }
}
