<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create() {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        };

        return back()->withErrors([
            'email' => 'Email does not exist',
            'password' => 'Password is incorrect',
        ]);
    }

    public function destroy(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }

    public function profile(Request $request) {

        $tweets = Tweet::where('user_id', auth()->id())
            ->with('user')
            ->latest()
            ->paginate();

        if($request->wantsJson()){
            return $tweets;
        };


        return Inertia::render('profile', [
            'tweets' => $tweets
        ]);
    }
}
