<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;
use App\Http\controllers\ProductController;
use App\Http\controllers\SaleController;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;

// ------------------------------------------------------
// Home Route
Route::get('/', function () { $products = Product::all(); return view('home', ['products' => $products]); });

// ------------------------------------------------------
// View All Categories
Route::get('/product_management/category/create_category', [ProductController::class, 'create_category_view']);
Route::post('/product_management/category/create_category', [ProductController::class, 'create_category']);
Route::get('/product_management/category/view_category/{category}', [ProductController::class, 'create_view_category_view']);
Route::get('/product_management/category/update_category/{category}', [ProductController::class, 'create_update_category_view']);
Route::put('/product_management/category/update_category/{category}', [ProductController::class, 'update_category']);
Route::delete('/product_management/category/delete_category/{category}', [ProductController::class, 'delete_category']);

// ------------------------------------------------------
// View All Suppliers
Route::get('/product_management/supplier/create_supplier', [ProductController::class, 'create_supplier_view']);
Route::post('/product_management/supplier/create_supplier', [ProductController::class, 'create_supplier']);
Route::get('/product_management/supplier/view_supplier/{supplier}', [ProductController::class, 'create_view_supplier_view']);
Route::get('/product_management/supplier/update_supplier/{supplier}', [ProductController::class, 'create_update_supplier_view']);
Route::put('/product_management/supplier/update_supplier/{supplier}', [ProductController::class, 'update_supplier']);
Route::delete('/product_management/supplier/delete_supplier/{supplier}', [ProductController::class, 'delete_supplier']);

// ------------------------------------------------------
// View All Orders
Route::get('/product_management/order/create_order', [ProductController::class, 'create_order_view']);
Route::post('/product_management/order/create_order', [ProductController::class, 'create_order']);
Route::get('/product_management/order/view_order/{order}', [ProductController::class, 'create_view_order_view']);
Route::get('/product_management/order/update_order/{order}', [ProductController::class, 'create_update_order_view']);
Route::put('/product_management/order/update_order/{order}', [ProductController::class, 'update_order']);
Route::delete('/product_management/order/delete_order/{order}', [ProductController::class, 'delete_order']);
// ------------------------------------------------------
// Product Management Routes
// View All Products
Route::get('/product_management',  [ProductController::class, 'create_product_management_view']);
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
Route::delete('/product_management/delete_product/{product}', [ProductController::class, 'delete_product']);
// ------------------------------------------------------

// Sale Management Routes
// View All Sales
Route::get('/sale_management', [SaleController::class, 'create_sale_management_view']);
// Create Sale
Route::get('/sale_management/create_sale', [SaleController::class, 'create_sale_view']);
Route::post('/sale_management/create_sale', [SaleController::class, 'create_sale'])->name('sale_management.create_sale');
// View Sale
Route::get('/sale_management/view_transaction/{transaction}', [SaleController::class, 'create_view_transaction_view']);
// Update Sale
Route::get('/sale_management/update_sale/{sale}', [SaleController::class, 'create_update_sale_view']);
Route::put('/sale_management/update_sale/{sale}', [SaleController::class, 'update_sale']);
// Delete Sale
Route::delete('/sale_management/delete_sale/{sale}', [SaleController::class, 'delete_sale']);
Route::delete('/sale_management/delete_transaction/{transaction}', [SaleController::class, 'delete_transaction']);

// Report Management Routes
// View All Reports
Route::get('/report_management', [ReportController::class, 'create_report_management_view']);

// ------------------------------------------------------
// User Management Routes
// View Changes
Route::get('/user_management', [UserController::class, 'create_user_management_view']);
// View User
Route::get('/user_management/view_user/{user}' , [UserController::class, 'view_user']);
// Create User
Route::get('/user_management/create_user' , [UserController::class, 'create_user']);
Route::post('/user_management/create_user' , [UserController::class, 'store_user']);
// Update User
Route::get('/user_management/update_user/{user}' , [UserController::class, 'update_user']);
Route::put('/user_management/update_user/{user}' , [UserController::class, 'update_user_post']);
// Delete User
Route::delete('/user_management/delete_user/{user}', function (User $user) { $user->delete(); return redirect('/user_management'); });
// ------------------------------------------------------
// Authentication Routes
// Log in, Register and Logout
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
// ------------------------------------------------------


