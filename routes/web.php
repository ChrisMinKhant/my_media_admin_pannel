<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});

Route::middleware('auth:sanctum')->group(function () {
    //Resource Controllers For Admin's Action
    Route::resource('admin', AdminController::class);

    //Resource Controllers For Post's Action
    Route::resource('post', PostController::class);

    //Resource Controllers For Category's Action
    Route::resource('category', CategoryController::class);

    //Resource Controllers For ActionLog's Action
    Route::resource('actionlog', ActionLogController::class);
});
