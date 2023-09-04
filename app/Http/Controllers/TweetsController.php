<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Tweet;
use App\Models\TweetView;
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
                },
                'tweet_view'
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

    public function show(User $user,Tweet $tweet, Request $request) {
        $tweetStats = [
            'likes_count' => $tweet->likes()->count(),
            'liked' => $tweet->likes()->where('user_id', auth()->id())->exists(),
            'tweet_view_count' => $tweet->tweet_view()->count(),
        ];

        TweetView::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'tweet_id' => $tweet->id,
            'user_id' => $request?->user?->id
        ]); 
    
        return Inertia::render('detail', [
            'tweet' => $tweet->load('user'),
            'tweetStats' => $tweetStats,
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'content' => ['required','max:270'],
            'mediaIds.*' => [
                Rule::exists('media', 'id')
                    ->where(function($q) use ($request) {
                        return $q->where('user_id', $request->user()->id);
                })
            ],
        ]); 
 
        $tweet = Tweet::create([
            'user_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        Media::find($request->input('mediaIds'))->each->update([
            'model_id' => $tweet->id,
            'model_type' => Tweet::class,
        ]);

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        return Inertia::render('TwitSearch', [
            'users' => User::query()
                ->when($search, fn($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
                // ->whereNot('id', auth()->user()->id)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get()
        ]);
    }

    // public function search(Request $request)
    // {
    //     $search = $request->input('search');

    //     return Inertia::render('TwitSearch', [
    //         'users' => User::query()
    //             ->when($search, fn($query, $search) => $query->where('username', 'like', '%' . $search . '%'))
    //             // ->whereNot('id', auth()->user()->id)
    //             ->orderBy('id', 'desc')
    //             ->paginate(10)
    //             ->withQueryString()
    //     ]);
    // }

}
