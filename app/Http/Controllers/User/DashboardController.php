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

        return Inertia::render('User/Dashboard', [
            'authenicated'   => $auth
        ]);
    }
}

