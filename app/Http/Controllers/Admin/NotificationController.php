<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', ['notifications' => $notifications]);
    }

    public function markAsRead($id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();

        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
}
