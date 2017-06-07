<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['start_date', 'end_date', 'extra_info', 'capacity', 'campsite_id', 'movement_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function campsite()
    {
        return $this->belongsTo('App\Models\Campsite');
    }

    public function movement()
    {
        return $this->belongsTo('App\Models\Movement');
    }
}
