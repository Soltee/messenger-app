<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Message;
use Inertia\Inertia;

use App\Events\MessageSentEvent;

class MessageController extends Controller
{

    /**
     * Store  & Broadcast the message to others
     * 
    */
    public function store(Request $request)
    {
        $data    = $request->validate([
                        'room'     => 'required|integer',
                        'message'  => 'required'
                    ]);

        $user    = auth()->user();

        $room    = Room::findOrfail($data['room']);
        // dd($room->id);

        $message = $user->messages()->create([
            'room_id'   => $room->id,
            'message'   => $data['message']
        ]);


        broadcast(new MessageSentEvent($message, $user, $room));

        return response()->json([
            'newMessage'  => $message
        ], 201);
    
    }
}
