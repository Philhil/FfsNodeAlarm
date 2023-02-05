<?php

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
//Public Rest API
Route::get('{mac}/', [\App\Http\Controllers\NodeController::class, 'index']);
Route::get('{mac}/clients', [\App\Http\Controllers\NodeController::class, 'clients']);
Route::get('{mac}/clientcount', [\App\Http\Controllers\NodeController::class, 'clients']);
Route::get('{mac}/isonline', [\App\Http\Controllers\NodeController::class, 'isOnline']);

