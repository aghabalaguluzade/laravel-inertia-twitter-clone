<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LikedTweetsController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\UserNotificationsController;
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

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);


Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [UserNotificationsController::class, 'index']);
    Route::get('/', [TweetsController::class, 'index']);
    Route::get('/{user:username}/status/{tweet:id}', [TweetsController::class, 'show']);
    Route::post('/tweets', [TweetsController::class, 'store']);
    Route::get('/{user:username}/following', [UserFollowController::class, 'followingIndex']);
    Route::post('/{user:username}/following/{id}', [UserFollowController::class, 'followingStore']);
    Route::delete('/{user:username}/following/{id}', [UserFollowController::class, 'followingDestroy']);
    Route::get('/{user:username}/followers', [UserFollowController::class, 'followersIndex']);
    Route::get('/profile', [LoginController::class, 'profile']);
    Route::get('/{user:username}', [TweetsController::class, 'users']);
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/tweets/{tweet:id}/like', [LikedTweetsController::class, 'toogle'])->name('toogle');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});