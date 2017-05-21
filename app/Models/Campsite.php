<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campsite extends Model
{
    protected $fillable = [''];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
