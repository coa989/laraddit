<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '<', 3)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', ['users'=> $users]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function changeRole(User $user)
    {
        if ($user->role->name === 'Guest') {
            $user->update(['role_id' => 2]);
            return back();
        }

        $user->update(['role_id' => 1]);
        return back();
    }

    public function guests()
    {
        $guests = User::where('role_id', 1)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.guests', ['guests' => $guests]);
    }

    public function authors()
    {
        $authors = User::where('role_id', 2)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.authors', ['authors' => $authors]);
    }
}
