<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserNotificationsController extends Controller
{
    public function index() {

        auth()->user()->unreadNotifications->markAsRead();

        $notifications = auth()->user()->notifications()->latest()->paginate();

        if(request()->wantsJson()) {
            return $notifications;
        }

        return Inertia::render('notifications', [
            'notifications' => $notifications
        ]);
    }
}
