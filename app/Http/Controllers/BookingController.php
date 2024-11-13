<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Booking;

class BookingController extends Controller
{
    //
    public function show():View{
        $bookings = Booking::with('user', 'room')->get();
        return view('bookings.index', compact('bookings'));
    }
}
