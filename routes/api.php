<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\Auth\AuthController;

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



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);




Route::group(['middleware'=>['api', 'auth:sanctum']], function(){

Route::get('/MyProfile', [AuthController::class, 'Profile']);
Route::post('/EditProfile', [AuthController::class, 'edit_profile']);
Route::post('/AddPost', [PostController::class, 'store']);
Route::get('/Posts', [PostController::class, 'index']);
Route::get('/ShowPost/{id}/{slug}', [PostController::class, 'show']);

});

