<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Message;
use App\Events\MessageSentEvent;

class RoomMessageController extends Controller
{
    /**
     * Get the Messages of room
     * 
    */
    public function index(Room $room)
    {
        
        return response()->json([
            'messagesArray'     => $room->messages()
                                    ->latest()
                                    ->with('user')
                                    ->paginate(8)
                                    ->transform(function($m) {
                                        return [
                                            'id'         => $m->id,
                                            'user'       => $m->user,
                                            'content'    => $m->message,
                                            'created'    => $m->created_at
                                        ];
                                    })
        ], 200);

    }

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
