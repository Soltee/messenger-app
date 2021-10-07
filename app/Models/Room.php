<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function joinedByUsers()
    {
        return $this->belongsToMany(User::class, 'room_user')
            ->withTimestamps();
    }

    /**
     * Join a chat room
     * 
     * @param \App\User $user
     */
    public function join(User $user)
    {
        return $this->joinedByUsers()->attach($user);
    }

    /**
     * Leave a chat room
     * 
     * @param \App\User $user
     */
    public function leave(User $user)
    {
        return $this->joinedRooms()->detach($user);
    }
}
