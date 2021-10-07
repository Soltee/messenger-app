<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RoomController;
use App\Http\Controllers\User\MessageController;


Route::group(['middleware' => 'guest'], function(){
    Route::get('/', [WelcomeController::class, 'index'])
                    ->name('welcome');

    //Authentication Routes
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/signup', [RegisteredUserController::class, 'store']);

});

//Authenticated
Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])
                                ->name('dashboard');

    //Room
    Route::get('/rooms/{room}', [RoomController::class, 'show'])
                                ->name('room');
    Route::patch('/rooms/{room}', [RoomController::class, 'toggle']);

    //Messages
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);

});


require __DIR__.'/auth.php';
