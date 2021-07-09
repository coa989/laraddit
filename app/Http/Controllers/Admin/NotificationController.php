<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', ['notifications' => $notifications]);
    }

    public function markAsRead($id)
    {
        $notifications = auth()->user()->unreadNotifications->where('id', $id);

        dd($notifications);
    }
}
