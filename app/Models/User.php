<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function rooms() {
        return $this->hasMany(Room::class);
    }

    public function joinedRooms()
    {
        return $this->belongsToMany(Room::class, 'room_user')
                ->withTimestamps();
    }

    /**
     * Join a new room
     * 
     * @param \App\Room $room
     */
    public function joinRoom($room)
    {
        return $this->joinedRooms()->attach($room);
    }

    /**
    * Check if user has joined room
     * 
     * @param mixed $roomId
     * 
     * @return bool
     */
    public function hasJoined($roomId)
    {
        return $this->joinedRooms()->where('room_id', $roomId)->firstOrfail() 
                    ? true : false;
    }
}
