<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function campsites()
    {
        return $this->hasMany('App\Models\Campsite');
    }
}