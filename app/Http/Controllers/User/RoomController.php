<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

use App\Models\Room;
use App\Models\User;

class RoomController extends Controller
{

    /**
     * Create Room Page
     * 
    */
    public function create()
    {
        $auth     =  auth()->user();
        $rooms    = $auth->rooms()
                            ->latest()
                            ->with('joinedByUsers')
                            ->filter(request()->only('search'))
                            ->paginate(8);
        return Inertia::render('User/Room/Create', [
            'authenicated'   => $auth,
            'search'         => request()->search,
            'rooms'          => $rooms      
        ]);

    }

    /**
     * Store New Room
     * 
    */
    public function store(Request $request)
    {
        $validated     = $request->validate([
                'name' => 'required|string|min:3|unique:rooms'
            ]);

        $room = auth()->user()->rooms()->create([
            'name'   => $validated['name'],
            'slug'   => Str::slug($validated['name'])
        ]);

        auth()->user()->joinedRooms()->toggle($room);

        return back()->with(['room' => $room]);

    }

    /**
     * Update Room
     * 
    */
    public function update(Request $request, Room $room)
    {
        $validated     = $request->validate([
                'name' => 'required|string|min:3|unique:rooms'
            ]);

        $room = $room->update([
            'name'   => $validated['name'],
            'slug'   => Str::slug($validated['name'])
        ]);

        return back()->with(['room' => $room]);

    }

    /**
     * Destroy Room
     * 
    */
    public function destroy(Room $room)
    {
        auth()->user()->joinedRooms()->toggle($room);

        foreach($room->messages as $message){
            $message->delete();
        }

        $room->delete();

        return back();

    }


}
