<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TweetsController extends Controller
{
    public function index(Request $request) {
        $tweets = Tweet::with('user')->inRandomOrder()->paginate();

        if($request->wantsJson()){
            return $tweets;
        };

        return Inertia::render('index', [
            'tweets' => $tweets
        ]);
    }
}
