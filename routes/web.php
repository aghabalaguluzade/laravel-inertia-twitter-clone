<?php

use App\Http\Controllers\UserTweetsController;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     // return view('welcome');
//     $users = User::all();
//     return Inertia::render('UserTweets', [
//             'users' => $users,
//             'tweets' => $users->tweets()->paginate()
//         ]);
// });

Route::get('/', function () { 
    $tweets = Tweet::with('user')->inRandomOrder()->paginate(10);

    if(request()->wantsJson()){
        return $tweets;
    };

    return Inertia::render('index', [
        'tweets' => $tweets
    ]);
});

Route::get('/users/{user}', [UserTweetsController::class, 'index']);
