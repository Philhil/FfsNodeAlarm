<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
require __DIR__.'/auth.php';

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('user-profile', [ProfileController::class, 'update']);
    Route::get('user-profile', function () {
        return view('pages.user-profile');
    })->name('user-profile');

	Route::get('tasks', [TaskController::class, 'index'])->name('tasks');
	Route::get('tasks/remove/{task}', [TaskController::class, 'destroy'])->name('tasks.delete');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
});
