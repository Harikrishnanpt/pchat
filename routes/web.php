<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PusherController;
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


//CHAT
Route::get('/', [PusherController::class,"index"])->name("index");
Route::post('/broadcast', [PusherController::class,"broadcast"])->name("broadcast");
Route::post('/receive', [PusherController::class,"receive"])->name("receive");