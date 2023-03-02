<?php

use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user_logout',[UserController::class,'logout']);
    Route::post('/user_registration',[UserController::class,'registration']);
});
Route::get('/users_data',[UserController::class,'index']);
Route::get('/user_show/{id}',[UserController::class,'show']);

Route::post('/user_login',[UserController::class,'login']);

