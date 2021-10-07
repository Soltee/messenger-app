<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Join Room 
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
     * Show the Specific room
     * 
    */
    public function show(Room $room)
    {
        $auth     =  auth()->user();
        $joined   = $room->joinedByUsers()
                        ->where('user_id', auth()->user()->id)
                        ->exists() ? true : false;
        // dd($room->user);

        return Inertia::render('Room/Show', [
            'authenicated'      => $auth,
            'room'              => $room,
            'admin'             => $room->user,
            'joined'            => $joined,
            'joinedUsers'       => $room->joinedByUsers()->get(),
            'messagesArray'     => $room->messages()
                                    // ->latest()
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
