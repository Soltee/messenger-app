<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    /**
     * Render  the Welcome page
     * 
    */
    public function index()
    {
    
        return Inertia::render('Welcome', [
            'canLogin'         => Route::has('login'),
            'canRegister'      => Route::has('register'),
            'laravelVersion'   => Application::VERSION,
            'phpVersion'       => PHP_VERSION
        ]);
    }
}
