<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFollowController extends Controller
{
    public function followersIndex(User $user) {
        return Inertia::render('followers', [
            'followers' => $user->followers()
            ->withCount(['followers as following' => function($q) {
                return $q->where('follower_id', auth()->id());
            }])
            ->withCasts(['following' => 'boolean'])
            ->paginate(),
            'profile' => [
                'user' => $user
            ]
        ]);
    }
    
    public function followingIndex(User $user) {
        return Inertia::render('following', [
            'followings' => $user->followings()
            ->withCount(['followers as following' => function($q) {
                return $q->where('follower_id', auth()->id());
            }])
            ->withCasts(['following' => 'boolean'])
            ->paginate(),
            'profile' => [
                'user' => $user
            ]
        ]);
    }

    public function followingStore(User $user, $id) {
        $user->followings()->attach($id);
        return back();
    }

    public function followingDestroy(User $user, $id) {
        $user->followings()->detach($id);
        return redirect()->back();
    }
}
