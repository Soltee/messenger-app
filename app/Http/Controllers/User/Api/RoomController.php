<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Get All Rooms : Joined & Available
     * 
    */
    public function index()
    {
        $rooms = Room::latest()
                    ->with('user', 'joinedByUsers')
                    ->filter(request()->only('search', 'type'))
                    ->paginate(6)
                    ->transform(function($r) {
                        return [
                            'id'         => $r->id,
                            'user'       => $r->user,
                            'name'       => $r->name,
                            'slug'       => $r->slug,
                            'users'      => $r
                                            ->joinedByUsers()
                                            ->count(),
                            'created'    => $r->created_at
                        ];
                    });

        return response()->json([
                'search'         => request()->search,
                'type'           => request()->type,
                'rooms'          => $rooms->items(),
                'prev'           => $rooms
                                        ->appends(request()->only('search', 'type'))
                                        ->previousPageUrl(),
                'next'           => $rooms
                                        ->appends(request()->only('search', 'type'))
                                        ->nextPageUrl(),
                'total'          => $rooms->total(),
                'last'           => $rooms->lastPage()
            ], 200);
    }

    /*
        * Get Authenticated User
    */
    protected function authenticated()
    {
        return auth()->user();
    }
}
