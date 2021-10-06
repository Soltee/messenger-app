<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Room;

class DashboardController extends Controller
{
    /**
     * Render User Dashboard
    */
    public function index()
    {
        return Inertia::render('Dashboard', [
            'authenicated'   => auth()->user(),
            'rooms'          => Room::latest()
                                    ->withCount('messages')
                                    ->with('user')
                                    ->paginate(10)
                                    ->transform(function($r) {
                                        return [
                                            'id'         => $r->id,
                                            'user'       => $r->user,
                                            'name'       => $r->name,
                                            'slug'       => $r->slug,
                                            'messages'   => $r->messages_count,
                                            'created'    => $r->created_at
                                        ];
                                    })
        ]);
    }
}

