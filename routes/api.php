<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//Register
Route::post('/register',[UserController::class,'register']);
//login 
Route::post('/login',[UserController::class,'login']);
Route::get('/users/{name}',[UserController::class,'users']); 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
