<?php

use App\Http\Controllers\APIControllers\AccountApiController;
use App\Http\Controllers\APIControllers\ActionLogApiController;
use App\Http\Controllers\APIControllers\AuthController;
use App\Http\Controllers\APIControllers\CategoryApiController;
use App\Http\Controllers\APIControllers\LikeAndCommentApiController;
use App\Http\Controllers\APIControllers\PostApiController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('api#login');
    Route::post('/register', 'register')->name('api#register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AccountApiController::class)->prefix('/account')->group(function () {
        Route::post('/create', 'createAccount')->name('api#accountcreate');
        Route::get('/get/{id}', 'getAccount')->name('api#accountget');
        Route::post('/update', 'updateAccount')->name('api#accountupdate');
        Route::get('changePassword/{id}', 'changePassword')->name('api#changepassword');
        Route::post('changeProfilePhoto', 'changeProfilePhoto')->name('api#changeprofilephoto');
    });

    Route::controller(PostApiController::class)->prefix('/post')->group(function () {
        Route::get('/get', 'getAllPosts')->name('api#postget');
    });

    Route::controller(CategoryApiController::class)->prefix('/category')->group(function () {
        Route::get('/get', 'getAllCategories')->name('api#categoryget');
    });

    Route::controller(LikeAndCommentApiController::class)->prefix('/likecomment')->group(function () {
        Route::post('/likecomment/{userId}/{postId}', 'likeComment')->name('api#likecommnet');
        Route::get('/get', 'getLikeComment')->name('api#getlikecomment');
    });

    Route::controller(ActionLogApiController::class)->prefix('/actionlog')->group(function () {
        Route::get('/actionlog/{userId}/{postId}', 'create')->name('api#actionlog');
    });
});
