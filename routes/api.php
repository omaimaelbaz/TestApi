<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/update/{id}', [CategoryController::class, 'update']);

Route::get('/users', [UserController::class, 'display']);
Route::post('/update/{id}', [UserController::class, 'modify']);
Route::get('/delete/{id}', [UserController::class, 'delete']);
// auth
Route::post("/login",[UserAuth::class,'index']);




Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('/index', [CategoryController::class, 'index']);
    Route::post('/create', [CategoryController::class, 'create']);
    Route::get('/delete/{id}', [CategoryController::class, 'delete']);




    });
    Route::post('/create', [UserController::class, 'create']);
