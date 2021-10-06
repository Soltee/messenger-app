<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RoomController;
use App\Http\Controllers\User\MessageController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Authenticated
Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])
                                ->name('dashboard');

    //Room
    Route::get('/rooms/{room}', [RoomController::class, 'show'])
                                ->name('room');

    //Messages
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);

});


require __DIR__.'/auth.php';
