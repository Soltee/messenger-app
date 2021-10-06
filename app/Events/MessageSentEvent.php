<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;

class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $room;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $user, Room $room)
    {
        $this->message = $message;
        $this->user = $user;
        $this->room = $room;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('chat');
        return new PresenceChannel('rooms.'. $this->message->room->id);
    }

    public function broadcastWith()
    {
        return [
            'user'      => $this->user,
            'id'        => $this->message->id,
            'name'      => $this->message->name, 
            'slug'      => $this->message->slug, 
            'content'   => $this->message->message, 
            'created'   => $this->message->created_at, 
        ];
    }
}
