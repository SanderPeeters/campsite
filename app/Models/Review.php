<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['campsite_id', 'user_id', 'review'];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
