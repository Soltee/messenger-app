<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RoomController;

use App\Http\Controllers\User\Api\RoomController as ApiRoomController;
use App\Http\Controllers\User\Api\RoomMessageController;

Route::group(['middleware' => 'guest'], function(){
    Route::get('/', [WelcomeController::class, 'index'])
                    ->name('welcome');

    //Authentication Routes
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/signup', [RegisteredUserController::class, 'store']);

});

//Authenticated
Route::group(['middleware' => ['auth', 'verified']], function(){

    //Account
    Route::get('/account', [AccountController::class, 'index'])
                                ->name('account');
    Route::patch('/account/{user}', [AccountController::class, 'updateAccount']);
    Route::patch('/password/{user}', [AccountController::class, 'updatePassword']);

    //Chat Page
    Route::get('/chat', [ChatController::class, 'index'])
                                ->name('chat');
    Route::get('/chat/{room}', [ApiRoomController::class, 'show']);
    Route::get('/chat/{room}/messages', [RoomMessageController::class, 'index']);


    Route::get('/dashboard', [DashboardController::class, 'index'])
                                ->name('dashboard');

    //Messages Api
    Route::post('/messages', [RoomMessageController::class, 'store']);

    //Room Api
    Route::get('/rooms', [ApiRoomController::class, 'index']);
    Route::get('/rooms/create', [RoomController::class, 'create'])
                                    ->name('new');
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::patch('/rooms/{room}', [RoomController::class, 'update']);
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);
    Route::patch('/{room}', [ApiRoomController::class, 'toggle']);  


});


require __DIR__.'/auth.php';
