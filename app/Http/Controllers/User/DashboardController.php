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
        $auth                = auth()->user();

        $joinedRooms         = $auth->joinedRooms->take(5);
        $joinedRoomsTotal    = $auth->joinedRooms->count();
        $createdRooms        = $auth->rooms->take(5);
        $createdRoomsTotal   = $auth->rooms->count();
        $messages            = $auth->messages->take(5);
        $messagesTotal       = $auth->messages->count();

        // dd($createdRooms);

        return Inertia::render('User/Dashboard', [
            'authenicated'         => $auth,
            'joinedRooms'          => $joinedRooms,
            'joinedRoomsTotal'     => $joinedRoomsTotal,
            'createdRooms'         => $createdRooms,
            'createdRoomsTotal'    => $createdRoomsTotal,
            'messages'             => $messages,
            'messagesTotal'        => $messagesTotal,
        ]);
    }
}

