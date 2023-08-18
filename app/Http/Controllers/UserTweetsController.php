<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserTweetsController extends Controller
{
    public function index(User $user) {
        // return Inertia::render('UserTweets', [
        //     'user' => $user,    
        //     'tweets' => $user->tweets()->with(['user'])->paginate(10)
        // ]);
        return Inertia::render('UserTweets');
    }
}
