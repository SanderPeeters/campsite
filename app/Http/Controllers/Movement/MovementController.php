<?php

namespace App\Http\Controllers\Movement;

use App\Models\Movement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovementController extends Controller
{
    public function getAllMovements()
    {
        $movements = Movement::all();
        return $movements;
    }
}
