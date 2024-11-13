<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    //
    public function show():View{
        $rooms= Room::all();
        $bookings = Booking::with('user', 'room')->get();
        return view('bookings.index', compact(['bookings', 'rooms']));
    }

    public function store(Request $request){
        $request->merge([
            'start_date' => convertirFechaIsoAFormatoBD($request->start_date),
            'end_date' => convertirFechaIsoAFormatoBD($request->start_date),
        ]);

        $validatedData = $request->validate([
            'room_id' => 'required|string|max:255',
            'user_id'=>'required|string|max:255',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);


        Booking::create($validatedData);

        return redirect()->route('bookings')->with('success', 'Booking created successfully.');
    }
}
