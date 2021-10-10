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
        $auth   = auth()->user();

        return Inertia::render('Dashboard', [
            'search'         => request()->search,
            'type'           => request()->type,
            'authenicated'   => $auth,
            'rooms'          => Room::latest()
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
                                    }),
            'joinedRooms'   => auth()
                                ->user()
                                ->joinedRooms()
                                ->latest()
                                // ->take(10)
                                ->get()
                                ->transform(function($r) {
                                        return [
                                            'id'         => $r->id,
                                            'name'       => $r->name,
                                            'slug'       => $r->slug,
                                            'users'      => $r
                                                            ->joinedByUsers()
                                                            ->count(),
                                            'created'    => $r->created_at
                                        ];
                                    })
        ]);
    }
}

