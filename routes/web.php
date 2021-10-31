<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UsersController::class, 'index']);
Route::post('/store', [UsersController::class, 'store']);
Route::post('/destroy/{id}', [UsersController::class, 'destroy']);
Route::post('/edit/{id}', [UsersController::class, 'edit']);
Route::get('/getUser/{id}', [UsersController::class, 'getUser']);