<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});  */



Route::post('login', [AuthController::class, 'login'])->middleware('jwt');
Route::post('logout', [AuthController::class, 'logout']);

// categories CRUD
Route::get('category/all', [CategoryController::class, 'getAll']);
Route::get('category/{id}', [CategoryController::class, 'getById']);
Route::post('category/store', [CategoryController::class, 'store']);
Route::post('category/{id}/update', [CategoryController::class, 'update']);
Route::delete('category/{id}/destroy', [CategoryController::class, 'destroy']);


//Post CRUD
Route::get('post/all', [PostController::class, 'getAll']);
Route::get('post/{id}', [PostController::class, 'getById']);
Route::post('post/store', [PostController::class, 'store']);
Route::post('post/{id}/update', [PostController::class, 'update']);
Route::delete('post/{id}/destroy', [PostController::class, 'destroy']);

//user CRUD
Route::get('user/all',[AuthController::class, 'getAll']);
Route::put('user/{id}/update',[AuthController::class, 'update']);
Route::get('user/{id}',[AuthController::class, 'getById']);
Route::delete('user/{id}/destroy',[AuthController::class, 'destroy']);
Route::post('user/store',[AuthController::class, 'store']);
