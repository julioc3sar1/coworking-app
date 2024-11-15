<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Room;

class RoomController extends Controller
{
    //
    public function show(): View
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function destroy(Room $room) {
        $room->delete();
        return redirect()->route('rooms')->with('success', 'Has borrado la sala');
    }

    public function store(RoomRequest $request){
        $validatedData = $request->validated();

        Room::create($validatedData);

        return redirect()->route('rooms')->with('success', 'Has creado una sala.');
    }

    public function update(RoomRequest $request, Room $room)
    {
        $request->validated();

        $room->name = $request->name;
        $room->description = $request->description;

        $room->update($request->all());

        return redirect()->route('rooms')->with('success', 'Has editado una sala.');
    }
}
