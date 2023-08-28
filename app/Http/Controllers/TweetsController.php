<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TweetsController extends Controller
{
    public function index(Request $request) {
        
       $tweets = Tweet::with('user')
            ->withCount([
                'likes',
                'likes as liked' => function($q){
                    $q->where('user_id', auth()->id());
                }
            ])
            ->withCasts([
                'liked' => 'boolean'
            ])
            ->latest()
            ->paginate();

        if($request->wantsJson()){
            return $tweets;
        };

        return Inertia::render('index', [
            'tweets' => $tweets
        ]);
    }

    public function users(Request $request, User $user) {

        $tweets = $user->tweets()->with('user')->latest()->paginate();

        if($request->wantsJson()){
            return $tweets;
        };

        return Inertia::render('users', [
            'user' => $user,
            'tweets' => $tweets
        ]);
    }

    public function show(Tweet $tweet) {
        $tweetStats = [
            'likes_count' => $tweet->likes()->count(),
            'liked' => $tweet->likes()->where('user_id', auth()->id())->exists(),
        ];
    
        return Inertia::render('detail', [
            'tweet' => $tweet->load('user'),
            'tweetStats' => $tweetStats,
        ]);
    }
    
}
