<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFollowController extends Controller
{
    public function followers(User $user) {
        return Inertia::render('followers', [
            'followers' => [],
            'profile' => [
                'user' => $user
            ]
        ]);
    }

    public function following(User $user) {
        return Inertia::render('following', [
            'following' => [],
            'profile' => [
                'user' => $user
            ]
        ]);
    }
}
