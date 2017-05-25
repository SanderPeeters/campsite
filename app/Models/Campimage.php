<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campimage extends Model
{
    protected $fillable = ['campsite_id', 'identifier', 'filename'];

    public function campsite()
    {
        return $this->belongsTo('App\Models\Campsite');
    }
}
