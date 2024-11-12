<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Sala;

class RoomController extends Controller
{
    //
    public function show(): View
    {
        $rooms = Sala::all();        
        return view('rooms.index', compact('rooms'));
    }
}
