<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('announcements')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
        ]);

        Category::create($validated);

        return back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return back()->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if ($category->announcements()->count() > 0) {
            return back()->with('error', 'Cannot delete category that has announcements.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}
