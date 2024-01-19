<?php

use App\Http\Controllers\Api\JwtApiController;
use App\Http\Controllers\Api\PostController;
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


Route::post('register',[JwtApiController::class,'register']);
Route::post('login', [JwtApiController::class,'login']);
Route::post('refresh', [JwtApiController::class,'refresh']);
Route::post('logout', [JwtApiController::class,'logout']);

Route::middleware('auth:api')->apiResource('posts', PostController::class);
