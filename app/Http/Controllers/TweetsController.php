<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TweetsController extends Controller
{
    public function index(Request $request) {

       $tweets = Tweet::where(function($q) {
                $q->where('user_id', auth()->id())
                    ->orWhereIn('user_id', auth()->user()->followings->pluck('id'));
            })
            ->withCount([
                'likes',
                'likes as liked' => function($q){
                    $q->where('user_id', auth()->id());
                }
            ])
            ->withCasts([
                'liked' => 'boolean'
            ])
            ->with(['user', 'media'])
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

        $tweets = $user->tweets()
            ->with('user')
            ->latest()
            ->paginate();

        if($request->wantsJson()){
            return $tweets;
        };

        return Inertia::render('users', [
            'user' => $user,
            'tweets' => $tweets,
            'tweets_count' => $user->tweets()->count(),
        ]);
    }

    public function show(User $user,Tweet $tweet) {
        $tweetStats = [
            'likes_count' => $tweet->likes()->count(),
            'liked' => $tweet->likes()->where('user_id', auth()->id())->exists(),
        ];
    
        return Inertia::render('detail', [
            'tweet' => $tweet->load('user'),
            'tweetStats' => $tweetStats,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'content' => 'required|max:280',
            'mediaIds.*' => [
                Rule::exists('media', 'id')
                    ->where(function($q) use ($request) {
                        $q->where('user_id', $request->user()->id);
                })
            ]
        ]);

        $tweet = Tweet::create([
            'user_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        Media::find($request->mediaIds)->each->update([
            'model_id' => $tweet->id,
            'model_type' => Tweet::class,
        ]);

        return redirect()->back();
    }
    
}
