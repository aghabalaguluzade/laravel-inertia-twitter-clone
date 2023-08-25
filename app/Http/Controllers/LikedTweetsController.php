<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class LikedTweetsController extends Controller
{
    public function toogle(Tweet $tweet) {
        $tweet->likes()->toggle(auth()->user());

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
