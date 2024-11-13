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

    public function destroy(Sala $room) {
        $room->delete();
        return redirect()->route('rooms')->with('success', 'Room deleted successfully');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description'=>'required|string|max:255'
        ]);

        Sala::create($validatedData);

        return redirect()->route('rooms')->with('success', 'Room created successfully.');
    }

    public function update(Request $request, Sala $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description'=>'required|string|max:255'
        ]);

        $room->name = $request->name;
        $room->description = $request->description;

        $room->update($request->all());

        return redirect()->route('rooms')->with('success', 'Room updated successfully.');
    }
}
