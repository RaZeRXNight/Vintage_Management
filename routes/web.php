<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;
use App\Http\controllers\ProductController;
use App\Models\User;
use App\Models\Product;

// View Changes
Route::get('/', function () { return view('home'); });

Route::get('/user_management', function () { $users = User::all(); return view('management/user_management', ['users' => $users]); });
// View User
Route::get('/user_management/view_user/{user}' , [UserController::class, 'view_user']);
// Update User
Route::get('/user_management/update_user/{user}' , [UserController::class, 'update_user']);

// Product Management Routes
Route::get('/product_management', function () { $products = Product::all(); return view('management/product_management', ['products' => $products]); });
// Create Product
Route::get('/product_management/create_product', [ProductController::class, 'create_product_view']);
Route::post('/product_management/create_product', [ProductController::class, 'create_product']);
// View Product
Route::get('/product_management/view_product/{product}', [ProductController::class, 'create_view_product_view']);
// Update Product
Route::get('/product_management/update_product/{product}', [ProductController::class, 'create_update_product_view']);
Route::put('/product_management/update_product/{product}', [ProductController::class, 'update_product']);

// Delete Product
Route::get('/product_management/delete_product/{product}', [ProductController::class, 'delete_product']);
route::delete('/product_management/delete_product/{product}', [ProductController::class, 'delete_product']);


// POST Routes
Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);


