<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;

use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Chat Page
     * 
    */
    public function index()
    {
        $auth     =  auth()->user();

        return Inertia::render('User/Chat/Index', [
            'authenicated'      => $auth            
        ]);

    }
}
