<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // لیست تمام صفحات (API)
    public function index()
    {
        return response()->json(Page::all());
    }

    // نمایش جزئیات یک صفحه (API)
    public function show(Page $page)
    {
        return response()->json($page);
    }

    // ایجاد یک صفحه جدید (API)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug',
            'content' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $page = Page::create($validated);
        return response()->json($page, 201);
    }

    // ویرایش یک صفحه (API)
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $page->update($validated);
        return response()->json($page);
    }

    // حذف یک صفحه (API)
    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(['message' => 'Page deleted successfully']);
    }

    // نمایش لیست صفحات در پنل ادمین
    public function adminIndex()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    // نمایش فرم ایجاد صفحه (پنل ادمین)
    public function create()
    {
        return view('admin.pages.create');
    }

    // ذخیره یک صفحه جدید از طریق پنل ادمین
    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug',
            'content' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        Page::create($validated);

        return redirect()->route('admin.pages')->with('success', 'Page created successfully!');
    }

    // نمایش فرم ویرایش یک صفحه (پنل ادمین)
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    // ویرایش یک صفحه از طریق پنل ادمین
    public function adminUpdate(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $page->update($validated);

        return redirect()->route('admin.pages')->with('success', 'Page updated successfully!');
    }
}
