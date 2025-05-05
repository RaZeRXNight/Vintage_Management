<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;

Route::get('/', function () {
    return view('home');
});


Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);
