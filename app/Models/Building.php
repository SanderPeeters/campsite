<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['campsite_id', 'capacity', 'has_water',
        'has_electricity', 'has_wifi', 'has_kitchen', 'beds', 'toilets', 'showers', 'extra_info'];

    public function campsite () {
        return $this->belongsTo('App\Campsite');
    }
}
