<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Notifications\LikedTweetNotification;
use Illuminate\Http\Request;

class LikedTweetsController extends Controller
{
    public function toogle(Tweet $tweet) {

        $result = $tweet->likes()->toggle(auth()->id());

        if(count($result['attached'])) {
            $tweet->user->notify(new LikedTweetNotification($tweet, auth()->user()));
        }

        $tweet->load('user')
            ->loadCount([
                'likes',
                'likes as liked' => function($q) {
                    $q->where('user_id', auth()->user()->id);
                }
            ]);

        return redirect()->back();
    }
}
