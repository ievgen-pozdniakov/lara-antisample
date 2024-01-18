<?php

use App\Http\Controllers\ActivateCategories;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CreateCategory;
use App\Http\Controllers\ListCategories;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UpdateCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admins', function (Request $request) {
    return User::all();
});
// Admin routes
Route::get('/admins/{adminId}', [Admin::class, 'view']);
Route::post('/admins/{adminId}', [Admin::class, 'create']);
Route::put('/admins/{adminId}', [Admin::class, 'update']);
Route::patch('/admins/{adminId}/change-password', [Admin::class, 'changePassword']);
Route::delete('/admins/{adminId}', [Admin::class, 'delete']);

// Category routes
Route::get('/categories', ListCategories::class);
Route::post('/categories', CreateCategory::class);
Route::put('/categories/{categoryId}', UpdateCategories::class);
Route::patch('/categories/{categoryId}/toggle-activity', ActivateCategories::class);
Route::delete('/categories/{categoryId}', ActivateCategories::class);

Route::apiResource('products', ProductsController::class);
Route::get('/products/{productId}/add-amount/{amount}', \App\Http\Controllers\AddProductAmount::class);
Route::delete('/products/{productId}/burn-amount', \App\Http\Controllers\BurnProductAmount::class);

Route::put('/discount/product/{productId', [\App\Http\Controllers\DiscountController::class, 'setProductDiscount']);
Route::put('/discount/category/{categoryId}', [\App\Http\Controllers\DiscountController::class, 'setCategoryDiscount']);
Route::put('/discount/reset-all', [\App\Http\Controllers\DiscountController::class, 'resetDiscount']);

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{orderId}', [OrderController::class, 'view']);
Route::get('/orders/{orderId}/confirm', [OrderController::class, 'confirm']);
Route::get('/orders/{orderId}/deliver', [OrderController::class, 'deliver']);
Route::get('/orders/{orderId}/finish', [OrderController::class, 'finish']);
Route::get('/orders/{orderId}/decline', [OrderController::class, 'decline']);
