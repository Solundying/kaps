<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Tab;
use Illuminate\Http\Request;

class TabController extends Controller
{
    // نمایش تمام تب‌های مربوط به یک صفحه (API)
    public function index(Page $page)
    {
        return response()->json($page->tabs);
    }

    // ایجاد یک تب جدید برای صفحه (API)
    public function store(Request $request, Page $page)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $tab = $page->tabs()->create($validated);

        return response()->json($tab, 201);
    }

    // نمایش یک تب خاص (API)
    public function show(Tab $tab)
    {
        return response()->json($tab);
    }

    // به‌روزرسانی یک تب خاص (API)
    public function update(Request $request, Tab $tab)
{
    // اعتبارسنجی مقادیر ورودی
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'order' => 'required|integer',
        'is_active' => 'required|boolean',
    ]);

    // به‌روزرسانی اطلاعات تب
    $tab->update($validated);

    // بازگشت به صفحه مدیریت تب‌ها پس از به‌روزرسانی
    return redirect()->route('admin.tabs', $tab->page_id)
                     ->with('success', 'Tab updated successfully!');
}


    // حذف یک تب (API)
    public function destroy(Tab $tab)
    {
        $tab->delete();

        return response()->json(['message' => 'Tab deleted successfully']);
    }

    // نمایش تب‌های مربوط به یک صفحه در پنل ادمین
    public function adminIndex(Page $page)
    {
        $tabs = $page->tabs;
        return view('admin.tabs.index', compact('page', 'tabs'));
    }

    // نمایش فرم ایجاد تب (پنل ادمین)
    public function create(Page $page)
{
    return view('admin.tabs.create', compact('page'));
}


    // ذخیره تب جدید (پنل ادمین)
    public function adminStore(Request $request, Page $page)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $page->tabs()->create($validated);

        return redirect()->route('admin.tabs', $page->id)->with('success', 'Tab created successfully!');
    }

    // نمایش فرم ویرایش تب (پنل ادمین)
    public function edit(Tab $tab)
    {
        return view('admin.tabs.edit', compact('tab'));
    }

    // به‌روزرسانی تب (پنل ادمین)
    public function adminUpdate(Request $request, Tab $tab)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $tab->update($validated);

        return redirect()->route('admin.tabs', $tab->page_id)->with('success', 'Tab updated successfully!');
    }

    // حذف تب (پنل ادمین)
    public function adminDestroy(Tab $tab)
    {
        $pageId = $tab->page_id;
        $tab->delete();

        return redirect()->route('admin.tabs', $pageId)->with('success', 'Tab deleted successfully!');
    }
}
