<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    //
    public function show(): View
    {
        return view('rooms.index');
    }
}
