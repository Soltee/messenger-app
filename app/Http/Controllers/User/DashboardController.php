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
            'authenicated'   => $auth,
            'rooms'          => Room::latest()
                                    ->with('user', 'joinedByUsers')
                                    // ->whereDoesntHave('joinedByUsers', function ($query) use ($auth) {
                                    //     $query
                                    //         ->where('room_user.user_id', '!==', $auth->id);
                                    // })
                                    ->whereDoesntHave('joinedByUsers')
                                    ->filter(request()->only('search'))
                                    ->paginate(10)
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

