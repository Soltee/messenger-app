<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Message;
use App\Models\Room;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('rooms.{room}', function ($user, Room $room) {
    $exists     =   $room->joinedByUsers()
                        ->where('user_id', auth()->user()->id)
                        ->exists() ? true : false;
    if($exists){
        return $user;
    }
});
