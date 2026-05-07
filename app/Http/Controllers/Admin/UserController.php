<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Don't show the current logged in admin in the list to prevent self-deletion
        $users = User::where('id', '!=', Auth::id())->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleRole(User $user)
    {
        $user->role = $user->role === 'admin' ? 'student' : 'admin';
        $user->save();

        return back()->with('success', "User role updated to {$user->role} successfully!");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }
}
