<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

use App\Models\Room;
use App\Models\User;

class RoomController extends Controller
{
    /**
     * Show All the Joined Rooms
     * 
    */
    public function index()
    {
        $auth     =  auth()->user();

        return Inertia::render('User/Room/Index', [
            'authenicated'      => $auth            
        ]);

    }

    /**
     * Create Room Page
     * 
    */
    public function create()
    {
        $auth     =  auth()->user();
        $rooms    = $auth->rooms()
                            ->with('joinedByUsers')
                            ->filter(request()->only('search'))
                            ->paginate(8);
        return Inertia::render('User/Room/Create', [
            'authenicated'   => $auth,
            'search'         => request()->search,
            'rooms'          => $rooms,
            // 'prev'           => $rooms
            //                         ->appends(request()->only('search', 'type'))
            //                         ->previousPageUrl(),
            // 'next'           => $rooms
            //                         ->appends(request()->only('search', 'type'))
            //                         ->nextPageUrl(),
            // 'total'          => $rooms->total(),
            // 'last'           => $rooms->lastPage()        
        ]);

    }

    /**
     * Store New Room
     * 
    */
    public function store(Request $request)
    {
        $validated     = $request->validate([
                'name' => 'required|string|min:3|unique:rooms'
            ]);

        $room = auth()->user()->rooms()->create([
            'name'   => $validated['name'],
            'slug'   => Str::slug($validated['name'])
        ]);

        auth()->user()->joinedRooms()->toggle($room);

        return back()->with(['room' => $room]);

    }


}
