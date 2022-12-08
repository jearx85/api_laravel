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
Route::group(['prefix' => 'category'], function(){
Route::get('/all', [CategoryController::class, 'getAll']);
Route::get('{id}/edit', [CategoryController::class, 'edit']);
Route::post('/store', [CategoryController::class, 'store']);
Route::put('/{id}/update', [CategoryController::class, 'update']);
Route::delete('/{id}/destroy', [CategoryController::class, 'destroy']);
});

//Post CRUD
Route::group(['prefix' => 'post'], function(){
    Route::get('/all', [PostController::class, 'all']);
    Route::post('/store', [PostController::class, 'store']);
    Route::get('{id}/edit', [PostController::class, 'edit']);
    Route::put('{id}/update', [PostController::class, 'update']);
    Route::delete('{id}/destroy', [PostController::class, 'destroy']);
});

//user CRUD
Route::get('user/all',[AuthController::class, 'getAll']);
Route::put('user/{id}/update',[AuthController::class, 'update']);
Route::get('user/{id}',[AuthController::class, 'getById']);
Route::delete('user/{id}/destroy',[AuthController::class, 'destroy']);
Route::post('user/store',[AuthController::class, 'store']);
