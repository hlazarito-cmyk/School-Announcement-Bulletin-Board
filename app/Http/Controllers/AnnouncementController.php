<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Announcement;
use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    private function logActivity($description)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => $description,
        ]);
    }
    public function index(Request $request)
    {
        $query = Announcement::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $announcements = $query->with('category')->latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.announcements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
        ]);

        $announcement = Auth::user()->announcements()->create($validated);

        $this->logActivity("Created announcement: " . $announcement->title);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created successfully!');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        $categories = Category::all();
        return view('admin.announcements.edit', compact('announcement', 'categories'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
        ]);

        $announcement->update($validated);

        $this->logActivity("Updated announcement: " . $announcement->title);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully!');
    }

    public function destroy(Announcement $announcement)
    {
        $title = $announcement->title;
        $announcement->delete();

        $this->logActivity("Deleted announcement: " . $title);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully!');
    }

    public function togglePin(Announcement $announcement)
    {
        $announcement->update(['is_pinned' => !$announcement->is_pinned]);
        return back()->with('success', 'Announcement pin status updated!');
    }

    public function toggleArchive(Announcement $announcement)
    {
        $announcement->update(['is_archived' => !$announcement->is_archived]);
        return back()->with('success', 'Announcement archive status updated!');
    }
}
