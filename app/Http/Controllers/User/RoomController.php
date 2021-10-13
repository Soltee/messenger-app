<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Show All the Joined Rooms
     * 
    */
    public function index()
    {
        $auth     =  auth()->user();

        return Inertia::render('User/Room/Index', [
            'authenicated'      => $auth            
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


}
