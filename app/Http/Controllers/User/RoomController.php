<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Room;

class RoomController extends Controller
{

    /**
     * Show the Specific room
     * 
    */
    public function show(Room $room)
    {
        return Inertia::render('Room/Show', [
            'authenicated'      => auth()->user(),
            'room'              => $room,
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
