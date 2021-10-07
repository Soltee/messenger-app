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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
