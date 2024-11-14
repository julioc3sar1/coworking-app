<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Rules\Available;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    //
    public function show(Request $request):View{
        $user = Auth::user();
        $rooms= Room::all();
        $roomId = $request->id;
        $bookings = Booking::with('user', 'room');
    
        if(!$user->hasRole('admin')){
            $bookings->where('user_id',$user->id);
        }

        if($request->id){
            $bookings->where('room_id',$roomId);
        }

        $bookings = $bookings->get();

        return view('bookings.index', compact(['bookings', 'rooms', 'roomId']));
    }

    public function store(Request $request){
        $request->merge([
            'start_date' => convertirFechaIsoAFormatoBD($request->start_date),
            'end_date' => Carbon::parse(convertirFechaIsoAFormatoBD($request->start_date))->addHour(),
        ]);

        $validatedData = $request->validate([
            'room_id' => ['required','string','max:255',new Available],
            'user_id'=>'required|string|max:255',   
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date'
        ]);

        Booking::create($validatedData);

        return redirect()->route('bookings')->with('success', 'Has creado una reserva.');
    }

    public function updateStatus(Request $request, String $id){
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $booking = Booking::find($id);
        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('bookings')->with('success', 'Has cambiado el estado de una reserva.');
    }
}
