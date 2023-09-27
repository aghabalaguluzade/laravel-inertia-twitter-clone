<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TweetCommentsController extends Controller
{
    public function index(Request $request) {
    }

    public function reply(Request $request) {

        try {
            $request->validate([
                'tweet_id' => ['required'],
                'body' => ['required','max:280'],
                'mediaIds.*' => [
                    Rule::exists('media', 'id')
                        ->where(function($q) use ($request) {
                            return $q->where('user_id', $request->user()->id);
                    })
                ],
            ]);
    
            $comment = Comment::create([
                'user_id' => auth()->id(),
                'tweet_id' => $request->input('tweet_id'),
                'body' => $request->input('body'),  
            ]);
    
            Media::find($request->input('mediaIds'))->each->update([
                'mediaable_id' => $comment->id,
                'mediaable_type' => Tweet::class,
            ]);
    
            return redirect()->back();
        } catch (\Throwable $th) {
            return false;
        }

    }
}
