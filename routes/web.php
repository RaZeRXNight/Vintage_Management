<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;
use App\Models\User;

// View Changes
Route::get('/', function () {
    return view('home');
});

Route::get('/user_management', function () {
    $users = User::all();
    return view('user_management', ['users' => $users]);
});

Route::get('/product_management', function () {
    return view('product_management');
});


// POST Routes
Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);


