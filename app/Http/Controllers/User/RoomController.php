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
     * Toggle Room 
     * 
    */
    public function toggle(Room $room)
    {
        auth()->user()->joinedRooms()->toggle($room);

        return response()->json([
            'users'   => $room->joinedByUsers()->get()
        ], 200);
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
     * Show the Specific room
     * 
    */
    public function show(Room $room)
    {
        $auth     =  auth()->user();
        $joined   = $room->joinedByUsers()
                        ->where('user_id', auth()->user()->id)
                        ->exists() ? true : false;
        return Inertia::render('Room/Show', [
            'authenicated'      => $auth,
            'room'              => $room,
            'admin'             => $room->user,
            'joined'            => $joined,
            'joinedUsers'       => $room->joinedByUsers()->paginate(1),
            'messagesArray'     => $room->messages()
                                    ->latest()
                                    ->with('user')
                                    ->paginate(10)
                                    ->transform(function($m) {
                                        return [
                                            'id'         => $m->id,
                                            'user'       => $m->user,
                                            'content'    => $m->message,
                                            'created'    => $m->created_at
                                        ];
                                    })
        ]);

    }
}
