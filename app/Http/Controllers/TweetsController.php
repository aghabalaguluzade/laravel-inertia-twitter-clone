<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Tweet;
use App\Models\TweetView;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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

        if (!Cookie::has('viewed_posts')) {
            $viewedPosts = [];
        } else {
            $viewedPosts = json_decode(Cookie::get('viewed_posts'), true);
        }
        
        if (!in_array($tweet->id, $viewedPosts)) {
            TweetView::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'tweet_id' => $tweet->id,
                'user_id' => $request->user()?->id,
            ]);
        
            $viewedPosts[] = $tweet->id;
        
            Cookie::queue('viewed_posts', json_encode($viewedPosts), 60 * 24 * 365);
        }
    
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
        $search = preg_replace('/[+\-*><()~"@]/', '', trim(request('search')));
        $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');

        if(!$search) {
            return response()->json([]);
        }

        $search .= '*';

        $users = User::query()
            ->selectRaw('id, username, name, profile_photo_path, MATCH(username, name) AGAINST(? IN BOOLEAN MODE) as score', [$search])
            ->whereFullText(['username', 'name'], $search, ['mode' => 'boolean'])
            ->orderByDesc('score')
            ->limit(10)
            ->get();
        

        if($request->wantsJson()) {
            return $users;
        };

        return Inertia::render('TwitSearch', [
            'users' => $users
        ]);
    }

}