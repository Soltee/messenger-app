<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

use App\Models\User;
use Inertia\Inertia;

class AccountController extends Controller
{
    /**
     * User Account Page
    */
    public function index()
    {
        return  Inertia::render('User/Account', [
            'authenicated'  => auth()->user()    
        ]);
    }

    /**
     * User Account Update
    */
    public function updateAccount(Request $request, $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2',
            'email'    => 'required|email|unique:users',
        ]);

        $this->checkAuthenticated($user);

        auth()->user()->update($validated);

        return back();
        
    }

    /**
     * User Password Update
    */
    public function updatePassword(Request $request, $user)
    {
        $validated = $request->validate([
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $this->checkAuthenticated($user);

        auth()->user()->update([
            'password'   => bcrypt($validated['password'])
        ]);

        return back();


    }

    /**
     * Check if Auth->id === to passed id
    */
    protected function checkAuthenticated($id)
    {
        return (auth()->user()->id === $id) ? true : false;
    }
}
