<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Message;

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
                                    ->paginate(4)
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
}
