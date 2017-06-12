<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = ['campsite_id', 'user_id'];

    public function campsite ()
    {
        return $this->belongsTo() ('App\Models\Campsite');
    }

    public function user ()
    {
        return $this->belongsTo() ('App\User');
    }
}
