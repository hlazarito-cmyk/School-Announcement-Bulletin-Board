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
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
