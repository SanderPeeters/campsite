<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['start_date', 'end_date', 'extra_info', 'capacity', 'campsite_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
