<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Announcement;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::where('is_archived', false);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $announcements = $query->orderBy('is_pinned', 'desc')
                               ->orderBy('created_at', 'desc')
                               ->paginate(12);

        $categories = Announcement::select('category')->distinct()->pluck('category');

        return view('student.bulletin', compact('announcements', 'categories'));
    }

    public function show(Announcement $announcement)
    {
        if ($announcement->is_archived) {
            abort(404);
        }

        return view('student.show', compact('announcement'));
    }
}
