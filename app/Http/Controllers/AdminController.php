<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Announcement;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Announcement::count(),
            'active' => Announcement::where('is_archived', false)->count(),
            'pinned' => Announcement::where('is_pinned', true)->count(),
            'recent' => Announcement::latest()->take(5)->get(),
            'users_count' => \App\Models\User::count(),
            'students_count' => \App\Models\User::where('role', 'student')->count(),
            'admins_count' => \App\Models\User::where('role', 'admin')->count(),
            'logs' => \App\Models\ActivityLog::with('user')->latest()->take(10)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
