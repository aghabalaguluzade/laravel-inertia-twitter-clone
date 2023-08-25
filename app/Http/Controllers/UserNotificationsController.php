<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserNotificationsController extends Controller
{
    public function index() {
        return Inertia::render('notifications', [
            'notifications' => auth()->user()->notifications()->latest()->paginate()
        ]);
    }
}
