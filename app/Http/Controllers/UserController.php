<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Regisers the User adding their Name, Email and Password to the Database.
    public function register(Request $request) {
        $incomingfields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'min:3', 'max:30'],
            'password' => ['required', 'max: 20']
        ]);
        
        $incomingfields['password'] = bcrypt($incomingfields['password']);
        $user = User::create($incomingfields);
        auth()->login($user);
        
        return redirect('/');
    }

    // Logs in a user based on the email and password, using Laravel's built in Authentication methods.
    public function login(Request $request) {
        $incomingfields = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (auth()->attempt(['email' => $incomingfields['email'],'password' => $incomingfields['password']])) {
            $request->session()->regenerate();
        } 
        return redirect('/');
    }

    // Logs the User out.
    public function logout(Request $request) {
        auth()->logout();
        return redirect('/');
    }
}
